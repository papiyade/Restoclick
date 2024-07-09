<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Plat;
use App\Models\DetailCommande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Notification;
use App\Models\Paiement;
use App\Models\Restaurant;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Dompdf\Options;

use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {

        $order = new Commande();
        $order->restaurant_id = $request->restaurant_id;
        $order->client_name = $request->client_name;
        $order->telephone_client = $request->telephone_client;
        $order->total_price = $request->totalPrice; // Assurez-vous d'envoyer le totalPrice depuis le formulaire

        $order->save();

        // Enregistrez les détails de la commande
        foreach (json_decode($request->cart) as $item) {
            $detail = new DetailCommande();
            $detail->order_id = $order->id;
            $detail->item_id = $item->id; // Assurez-vous que votre panier contient des IDs d'articles
            $detail->quantity = $item->quantity;
            $detail->price = $item->price;

            $detail->save();
        }

        return response()->json(['success' => true, 'message' => 'Commande enregistrée avec succès.']);
    }





    public function showOrders()
    {
        $admin = auth()->user();

        if ($admin && $admin->restaurant_id) {
            $commandes = Commande::where('restaurant_id', $admin->restaurant_id)->paginate(5);
            Log::info("Admin ID: {$admin->id}, Restaurant ID: {$admin->restaurant_id}, Orders Count: " . $commandes->total());
        } else {
            $commandes = collect();
            Log::info("Admin non authentifié ou sans restaurant_id.");
        }

        return view('admin.commandes.index', compact('commandes'));
    }



    public function index(Request $request)
    {
        $admin = auth()->user();

        if ($admin && $admin->restaurant_id) {
            $query = $request->input('search');
            $status = $request->input('status');

            $commandesQuery = Commande::where('restaurant_id', $admin->restaurant_id);

            if ($query) {
                $commandesQuery->where('client_name', 'LIKE', "%{$query}%");
            }

            if ($status) {
                $commandesQuery->where('statut', $status);
            }

            $commandes = $commandesQuery->paginate(5);

            Log::info("Admin ID: {$admin->id}, Restaurant ID: {$admin->restaurant_id}, Commandes Count: " . $commandes->total());
        } else {
            $commandes = collect();
            Log::info("Admin non authentifié ou sans restaurant_id.");
        }

        if ($request->ajax()) {
            return response()->json([
                'html' => view('partials.commande_row', compact('commandes'))->render()
            ]);
        }

        return view('admin.commandes.index', compact('commandes'));
    }

    public function show($id)
    {
        $commande = Commande::findOrFail($id);
        $commande->load('details.plat');
        // Calculer le prix total
        $totalPrice = $commande->details->sum(function ($detail) {
            return $detail->quantite * $detail->plat->price;
        });
        return response()->json([
            'html' => view('admin.commandes.details', compact('commande', 'totalPrice'))->render()
        ]);
    }

    public function commander(Request $request)
    {
        try {
            // Valider les données de la commande
            $validatedData = $request->validate([
                'client_name' => 'required|string',
                'telephone_client' => 'required|string',
                'restaurant_id' => 'required|exists:restaurants,id',
                'mode_paiement' => 'required|in:carte_credit,wave,om,especes',
                'code_pin' => 'nullable|string|max:255'
            ]);

            // Récupérez les données nécessaires depuis la requête
            $restaurantId = $validatedData['restaurant_id'];

            // Récupérez le panier depuis la session
            $cartKey = "cart_$restaurantId";
            $cart = session()->get($cartKey);

            // Vérifiez si $cart est vide ou non défini
            if (empty($cart)) {
                throw new \Exception('Le panier est vide ou invalide.');
            }

            // Créez une nouvelle commande associée au restaurant
            $commande = new Commande();
            $commande->restaurant_id = $restaurantId;
            $commande->client_name = $validatedData['client_name'];
            $commande->telephone_client = $validatedData['telephone_client'];
            $commande->save();

            // Récupérez les plats correspondants aux ID dans le panier
            $plats = Plat::whereIn('id', array_keys($cart))->get();

            // Calculer le total de la commande
            $totalOrderPrice = 0;

            // Enregistrez les détails de la commande (les plats commandés)
            foreach ($plats as $plat) {
                $quantity = $cart[$plat->id]['quantity'];
                $totalOrderPrice += $plat->price * $quantity;

                $detailCommande = new DetailCommande();
                $detailCommande->commande_id = $commande->id;
                $detailCommande->plat_id = $plat->id;
                $detailCommande->quantite = $quantity; // Quantité commandée
                $detailCommande->save();
            }

            // Créez le paiement associé
            $paiement = new Paiement();
            $paiement->commande_id = $commande->id;
            $paiement->montant = $totalOrderPrice; // Utiliser le montant total calculé
            $paiement->date_heure = now();
            $paiement->mode_paiement = $validatedData['mode_paiement'];
            if ($validatedData['mode_paiement'] != 'especes') {
                $paiement->cc_number = $validatedData['code_pin']; // Enregistrez le code pin dans un champ approprié
            }
            $paiement->save();

            // Ajouter une notification pour l'admin du restaurant
            Notification::create([
                'client_name' => $validatedData['client_name'],
                'client_phone_number' => $validatedData['telephone_client'],
                'date_time' => now(),
                'num_people' => 1, // Vous pouvez utiliser 1 par défaut ou ajouter une colonne quantité totale pour les commandes
                'message' => "{$validatedData['client_name']} vient de passer une commande.",
                'link' => route('admin.commandes.show', $commande->id),
                'is_read' => false,
                'restaurant_id' => $restaurantId, // Ajouter l'ID du restaurant associé à la notification
            ]);

            // Retournez une réponse JSON pour indiquer le succès
            return response()->json([
                'success' => true,
                'message' => 'Commande enregistrée avec succès!',
                'commande_id' => $commande->id, // Optionnel : retournez l'ID de la commande
            ]);
        } catch (\Exception $e) {
            // Retournez une réponse JSON pour indiquer l'échec avec l'erreur
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'enregistrement de la commande: ' . $e->getMessage(),
            ]);
        }
    }

    public function downloadPDF($id)
    {
        $commande = Commande::findOrFail($id);
        $commande->load('details.plat');

        // Calcul du prix total (si nécessaire)
        $totalPrice = $commande->details->sum(function ($detail) {
            return $detail->quantite * $detail->plat->price;
        });

        // Configuration de DOMPDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        // Création de l'instance de Dompdf
        $dompdf = new Dompdf($options);

        // Vue pour le PDF
        $pdf = view('admin.commandes.invoice_pdf', compact('commande', 'totalPrice'))->render();

        // Chargement du contenu HTML dans Dompdf
        $dompdf->loadHtml($pdf);

        // Réglages du format et de la taille du papier (optionnel)
        $dompdf->setPaper('A4', 'portrait');

        // Rendu du PDF
        $dompdf->render();

        // Téléchargement du PDF avec un nom de fichier
        return $dompdf->stream("commande_{$commande->id}_invoice.pdf");
    }
    public function changeStatus($id, $status)
    {
        $status = strtolower($status); // Convertir le statut en minuscule
        $commande = Commande::findOrFail($id);
        $commande->statut = $status;
        $commande->save();

        return response()->json(['success' => true]);
    }
}
