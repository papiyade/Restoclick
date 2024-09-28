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
use App\Models\Category;
use App\Models\Table;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Dompdf\Options;


use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{


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
            $commandeId = $request->input('commande_id');
            $dateCommande = $request->input('date_commande');
            $telephone = $request->input('telephone');

            $commandesQuery = Commande::where('restaurant_id', $admin->restaurant_id);

            if ($query) {
                $commandesQuery->where('client_name', 'LIKE', "%{$query}%");
            }

            if ($status) {
                $commandesQuery->where('statut', $status);
            }

            if ($commandeId) {
                $commandesQuery->where('id', $commandeId);
            }

            if ($dateCommande) {
                $commandesQuery->whereDate('created_at', $dateCommande);
            }

            if ($telephone) {
                $commandesQuery->where('telephone_client', 'LIKE', "%{$telephone}%");
            }
            // Ajout de l'ordre par commande récente
            $commandesQuery->orderBy('created_at', 'desc');

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

        return view('admin.commandes.index', compact('commandes', 'status'));
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
            // Validation des données de la requête
            $validatedData = $request->validate([
                'client_name' => 'required|string',
                'telephone_client' => 'required|string',
                'restaurant_id' => 'required|exists:restaurants,id',
                'mode_paiement' => 'required|in:carte_credit,wave,om,especes',
                'code_pin' => 'nullable|string|max:255',
                'mode_commande' => 'required|in:à emporter,sur place',
                'table_id' => 'nullable|exists:tables,id'
            ]);

            $restaurantId = $validatedData['restaurant_id'];
            $cartKey = "cart_$restaurantId";
            $cart = session()->get($cartKey);

            if (empty($cart)) {
                throw new \Exception('Le panier est vide ou invalide.');
            }

            // Création de la commande
            $commande = new Commande();
            $commande->restaurant_id = $restaurantId;
            $commande->client_name = $validatedData['client_name'];
            $commande->telephone_client = $validatedData['telephone_client'];
            $commande->mode_commande = $validatedData['mode_commande'];

            if ($validatedData['mode_commande'] == 'sur place' && $validatedData['table_id']) {
                $commande->table_id = $validatedData['table_id'];

                // Marquer la table comme occupée
                $table = Table::find($validatedData['table_id']);
                $table->marquerCommeOccupee();
            }

            $commande->save();

            // Calcul du temps total de préparation
            $plats = Plat::whereIn('id', array_keys($cart))->get();
            $totalOrderPrice = 0;
            $totalPreparationTime = 0;

            foreach ($plats as $plat) {
                $quantity = $cart[$plat->id]['quantity'];
                $totalOrderPrice += $plat->price * $quantity;
                $totalPreparationTime += $plat->preparation_time * $quantity;

                $detailCommande = new DetailCommande();
                $detailCommande->commande_id = $commande->id;
                $detailCommande->plat_id = $plat->id;
                $detailCommande->quantite = $quantity;
                $detailCommande->save();
            }

            // Calculer la moyenne du temps de préparation
            $totalQuantity = array_sum(array_column($cart, 'quantity'));
            $averagePreparationTime = $totalQuantity > 0 ? $totalPreparationTime / $totalQuantity : 0;

            $expirationTime = now()->addMinutes($averagePreparationTime)->toIso8601String();
            session()->put('timer_expiration_time', $expirationTime);


            // Enregistrement du paiement
            $paiement = new Paiement();
            $paiement->commande_id = $commande->id;
            $paiement->montant = $totalOrderPrice;
            $paiement->date_heure = now();
            $paiement->mode_paiement = $validatedData['mode_paiement'];
            if ($validatedData['mode_paiement'] != 'especes') {
                $paiement->cc_number = $validatedData['code_pin'];
            }
            $paiement->save();

            // Création de la notification
            Notification::create([
                'client_name' => $validatedData['client_name'],
                'client_phone_number' => $validatedData['telephone_client'],
                'date_time' => now(),
                'num_people' => 1,
                'message' => "{$validatedData['client_name']} vient de passer une commande.",
                'link' => route('admin.commandes.show', $commande->id),
                'is_read' => false,
                'restaurant_id' => $restaurantId,
            ]);

            // Redirection vers la page du restaurant après la commande
            return redirect()->route('restaurant.showById', ['id' => $restaurantId])
                ->with('success', 'Commande enregistrée avec succès!');
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'enregistrement de la commande: ' . $e->getMessage(),
            ]);
        }
    }

    public function downloadPDF($id)
    {
        // Récupération de la commande et des relations nécessaires
        $commande = Commande::findOrFail($id);
        $commande->load('details.plat', 'restaurant');

        // Vérification du mode de commande pour la commande actuelle
        if ($commande->mode_commande == 'à emporter') {
            // Assurez-vous que le mode de commande est correctement récupéré
            // et qu'il n'y a pas de conflits avec d'autres commandes
        }

        // Calcul du prix total pour cette commande
        $totalPrice = $commande->details->sum(function ($detail) {
            return $detail->quantite * $detail->plat->price;
        });

        // Options pour Dompdf (si nécessaire)
        $options = new \Dompdf\Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        // Création de l'instance de Dompdf
        $dompdf = new \Dompdf\Dompdf($options);

        // Rendu de la vue PDF en utilisant les bonnes données
        $pdf = view('admin.commandes.invoice_pdf', compact('commande', 'totalPrice'))->render();

        // Chargement du contenu HTML dans Dompdf
        $dompdf->loadHtml($pdf);

        // Réglage du format de papier
        $dompdf->setPaper('A4', 'portrait');

        // Rendu du PDF
        $dompdf->render();

        // Téléchargement du PDF avec le bon nom de fichier basé sur la commande
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

    public function encaisserCommande(Request $request, $id)
    {
        $commande = Commande::find($id);
        if ($commande->statut == 'en_cours') {
            $commande->statut = 'terminée';
            $commande->save();

            // Libérer la table associée
            if ($commande->table) {
                $table = $commande->table;
                $table->statut = 'disponible'; // Utilisez 'statut' au lieu de 'occupee'
                $table->save();
            }

            return response()->json(['status' => 'success', 'message' => 'Commande encaissée et table libérée.']);
        }

        return response()->json(['status' => 'error', 'message' => 'Erreur lors de l\'encaissement de la commande.']);
    }

    public function create()
    {
        $restaurantId = auth()->user()->restaurant_id;
        $restaurant = Restaurant::find($restaurantId);
        $menus = $restaurant ? $restaurant->menus : collect();
        $lastMenu = $menus->last();
        $tables = $restaurant->tables()->where('statut', 'disponible')->get();
        $categories = $lastMenu ? Category::whereIn('id', $lastMenu->plats->pluck('category_id'))->get() : collect();
        $plats = $lastMenu ? $lastMenu->plats : collect();

        return view('serveur.commandes.create', compact('restaurant', 'tables', 'plats', 'categories'));
    }

    public function store(Request $request)
    {
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'client_name' => 'required|string',
            'telephone_client' => 'required|string',
            'restaurant_id' => 'required|exists:restaurants,id',
            'mode_paiement' => 'required|in:carte_credit,wave,om,especes',
            'code_pin' => 'nullable|string|max:255',
            'mode_commande' => 'required|in:à emporter,sur place',
            'table_id' => 'nullable|exists:tables,id',
            'plats' => 'required|array',
            'plats.*' => 'required|integer|exists:plats,id', // Chaque plat doit être un ID valide
            'quantite' => 'nullable|array', // La quantité est facultative mais si présente, elle doit être valide
            'quantite.*' => 'nullable|integer|min:1', // Chaque quantité doit être un entier positif si elle est présente
        ]);

        // Récupérer l'ID du restaurant
        $restaurantId = $validatedData['restaurant_id'];

        try {
            // Créer une nouvelle commande
            $commande = new Commande();
            $commande->restaurant_id = $restaurantId;
            $commande->client_name = $validatedData['client_name'];
            $commande->telephone_client = $validatedData['telephone_client'];
            $commande->mode_commande = $validatedData['mode_commande'];
            $commande->table_id = $validatedData['table_id']; // Enregistrement de l'ID de la table si applicable
            $commande->save();

            $totalOrderPrice = 0; // Initialisation du montant total

            // Enregistrer les détails de la commande
            foreach ($validatedData['plats'] as $platId) {
                // Récupérer la quantité, ou utiliser 1 si non spécifiée
                $quantite = $validatedData['quantite'][$platId] ?? 1;

                // Récupérer l'objet Plat pour obtenir son prix
                $plat = Plat::find($platId);

                if (!$plat) {
                    throw new \Exception("Plat avec l'ID $platId non trouvé.");
                }

                $detailCommande = new DetailCommande();
                $detailCommande->commande_id = $commande->id;
                $detailCommande->plat_id = $platId;
                $detailCommande->quantite = $quantite;
                $totalOrderPrice += $plat->price * $quantite; // Utiliser l'objet Plat pour obtenir le prix

                $detailCommande->save();
            }

            // Créer l'enregistrement de paiement
            $paiement = new Paiement();
            $paiement->commande_id = $commande->id;
            $paiement->montant = $totalOrderPrice;
            $paiement->date_heure = now();
            $paiement->mode_paiement = $request->mode_paiement;

            if ($request->mode_paiement != 'especes') {
                $paiement->cc_number = $request->input('code_pin');
            }

            $paiement->save();

            // Marquer la table comme occupée si le mode de commande est sur place
            if ($validatedData['mode_commande'] === 'sur place' && $validatedData['table_id']) {
                $table = Table::find($validatedData['table_id']);
                if ($table) {
                    $table->update(['statut' => 'occupée']);
                }
            }

            // Rediriger avec un message de succès
            return redirect()->route('admin.commandes.index')->with('success', 'Commande créée avec succès !');
        } catch (\Exception $e) {
            // Gérer les erreurs
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }





    public function ajout()
    {
        $restaurantId = auth()->user()->restaurant_id;
        $restaurant = Restaurant::find($restaurantId);
        $menus = $restaurant ? $restaurant->menus : collect();
        $lastMenu = $menus->last();
        $tables = $restaurant->tables()->where('statut', 'disponible')->get();
        $categories = $lastMenu ? Category::whereIn('id', $lastMenu->plats->pluck('category_id'))->get() : collect();
        $plats = $lastMenu ? $lastMenu->plats : collect();

        return view('admin.commandes.ajout', compact('restaurant', 'tables', 'plats', 'categories'));
    }

    public function add(Request $request)
    {
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'client_name' => 'required|string',
            'telephone_client' => 'required|string',
            'restaurant_id' => 'required|exists:restaurants,id',
            'mode_paiement' => 'required|in:carte_credit,wave,om,especes',
            'code_pin' => 'nullable|string|max:255',
            'mode_commande' => 'required|in:à emporter,sur place',
            'table_id' => 'nullable|exists:tables,id',
            'plats' => 'required|array',
            'plats.*' => 'required|integer|exists:plats,id', // Chaque plat doit être un ID valide
            'quantite' => 'nullable|array', // La quantité est facultative mais si présente, elle doit être valide
            'quantite.*' => 'nullable|integer|min:1', // Chaque quantité doit être un entier positif si elle est présente
        ]);

        // Récupérer l'ID du restaurant
        $restaurantId = $validatedData['restaurant_id'];

        try {
            // Créer une nouvelle commande
            $commande = new Commande();
            $commande->restaurant_id = $restaurantId;
            $commande->client_name = $validatedData['client_name'];
            $commande->telephone_client = $validatedData['telephone_client'];
            $commande->mode_commande = $validatedData['mode_commande'];
            $commande->table_id = $validatedData['table_id']; // Enregistrement de l'ID de la table si applicable
            $commande->save();

            $totalOrderPrice = 0; // Initialisation du montant total

            // Enregistrer les détails de la commande
            foreach ($validatedData['plats'] as $platId) {
                // Récupérer la quantité, ou utiliser 1 si non spécifiée
                $quantite = $validatedData['quantite'][$platId] ?? 1;

                // Récupérer l'objet Plat pour obtenir son prix
                $plat = Plat::find($platId);

                if (!$plat) {
                    throw new \Exception("Plat avec l'ID $platId non trouvé.");
                }

                $detailCommande = new DetailCommande();
                $detailCommande->commande_id = $commande->id;
                $detailCommande->plat_id = $platId;
                $detailCommande->quantite = $quantite;
                $totalOrderPrice += $plat->price * $quantite; // Utiliser l'objet Plat pour obtenir le prix

                $detailCommande->save();
            }

            // Créer l'enregistrement de paiement
            $paiement = new Paiement();
            $paiement->commande_id = $commande->id;
            $paiement->montant = $totalOrderPrice;
            $paiement->date_heure = now();
            $paiement->mode_paiement = $request->mode_paiement;

            if ($request->mode_paiement != 'especes') {
                $paiement->cc_number = $request->input('code_pin');
            }

            $paiement->save();

            // Marquer la table comme occupée si le mode de commande est sur place
            if ($validatedData['mode_commande'] === 'sur place' && $validatedData['table_id']) {
                $table = Table::find($validatedData['table_id']);
                if ($table) {
                    $table->update(['statut' => 'occupée']);
                }
            }

            // Rediriger avec un message de succès
            return redirect()->route('admin.commandes.index')->with('success', 'Commande créée avec succès !');
        } catch (\Exception $e) {
            // Gérer les erreurs
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            // Trouver la commande par ID
            $commande = Commande::findOrFail($id);

            // Supprimer les détails de la commande
            DetailCommande::where('commande_id', $id)->delete();

            // Supprimer l'enregistrement de paiement
            Paiement::where('commande_id', $id)->delete();

            // Supprimer la commande
            $commande->delete();

            // Vérifier si une table était associée à la commande et la marquer comme disponible si c'était le cas
            if ($commande->table_id) {
                $table = Table::find($commande->table_id);
                if ($table) {
                    $table->update(['statut' => 'disponible']);
                }
            }

            // Rediriger avec un message de succès
            return response()->json(['success' => 'Commande supprimée avec succès !']);
        } catch (\Exception $e) {
            // Gérer les erreurs
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


}
