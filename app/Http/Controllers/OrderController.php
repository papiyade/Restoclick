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
use App\Models\Table;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Dompdf\Options;

use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{

//     public function create()
// {
//     $admin = auth()->user();
//     if ($admin && $admin->restaurant_id) {
//         $plats = Plat::where('restaurant_id', $admin->restaurant_id)->get();
//         return view('admin.commandes.create', compact('plats'));
//     }
//     return redirect()->route('admin.commandes.index')->with('error', 'Impossible de créer une commande.');
// }

public function store(Request $request)
{
    $validatedData = $request->validate([
        'client_name' => 'required|string',
        'telephone_client' => 'required|string',
        'plats' => 'required|array',
    ]);

    $commande = new Commande();
    $commande->client_name = $validatedData['client_name'];
    $commande->telephone_client = $validatedData['telephone_client'];
    $commande->restaurant_id = auth()->user()->restaurant_id;
    $commande->save();

    foreach ($validatedData['plats'] as $platId) {
        $plat = Plat::find($platId);
        if ($plat) {
            $detailCommande = new DetailCommande();
            $detailCommande->commande_id = $commande->id;
            $detailCommande->plat_id = $plat->id;
            $detailCommande->quantite = 1; // Par défaut 1, vous pouvez ajouter un champ pour la quantité
            $detailCommande->save();
        }
    }

    return redirect()->route('admin.commandes.index')->with('success', 'Commande créée avec succès.');
}

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

            $plats = Plat::whereIn('id', array_keys($cart))->get();
            $totalOrderPrice = 0;

            foreach ($plats as $plat) {
                $quantity = $cart[$plat->id]['quantity'];
                $totalOrderPrice += $plat->price * $quantity;

                $detailCommande = new DetailCommande();
                $detailCommande->commande_id = $commande->id;
                $detailCommande->plat_id = $plat->id;
                $detailCommande->quantite = $quantity;
                $detailCommande->save();
            }

            $paiement = new Paiement();
            $paiement->commande_id = $commande->id;
            $paiement->montant = $totalOrderPrice;
            $paiement->date_heure = now();
            $paiement->mode_paiement = $validatedData['mode_paiement'];
            if ($validatedData['mode_paiement'] != 'especes') {
                $paiement->cc_number = $validatedData['code_pin'];
            }
            $paiement->save();

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

            return redirect()->route('checkout', ['restaurant_id' => $restaurantId])->with('success', 'Commande enregistrée avec succès!');
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'enregistrement de la commande: ' . $e->getMessage(),
            ]);
        }
    }



    public function downloadPDF($id)
    {
        $commande = Commande::findOrFail($id);
        $commande->load('details.plat', 'restaurant');

        // Calcul du prix total (si nécessaire)
        $totalPrice = $commande->details->sum(function ($detail) {
            return $detail->quantite * $detail->plat->price;
        });

        // Configuration de DOMPDF
        $options = new \Dompdf\Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        // Création de l'instance de Dompdf
        $dompdf = new \Dompdf\Dompdf($options);

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




// app/Http/Controllers/OrderController.php

public function create()
{
    $restaurantId = auth()->user()->restaurant_id;

    // Affiche la vue pour créer une commande
    $tables = Table::where('restaurant_id', $restaurantId)->where('statut', 'disponible')->get();

    return view('serveur.commandes.create', compact('tables'));
}

// app/Http/Controllers/OrderController.php

// app/Http/Controllers/OrderController.php

public function selectTable(Request $request)
{
    // Assure-toi que l'utilisateur (serveur) est associé à un restaurant
    $restaurantId = auth()->user()->restaurant_id;

    // Récupérer les tables disponibles pour le restaurant

                   $tables = Table::where('restaurant_id', $restaurantId)->where('statut', 'disponible')->get();


    return response()->json(['tables' => $tables]);
}



public function addDishes(Request $request)
{
    $table = Table::findOrFail($request->query('table_id'));
    $plats = Plat::where('restaurant_id', $table->restaurant_id)->get();

    if ($request->wantsJson()) {
        return response()->json([
            'plats' => $plats
        ]);
    }

    return view('serveur.commandes.add-dishes', compact('table', 'plats'));
}



public function addClientInfo(Request $request)
{
    // Enregistre les informations client et le mode de paiement en session
    session()->put('order', $request->all());
    return view('serveur.commandes.add-client-info');
}

public function confirmOrder(Request $request)
{
    $data = session()->get('order');
    $validatedData = $request->validate([
        'client_name' => 'required|string',
        'telephone_client' => 'required|string',
        'mode_paiement' => 'required|in:carte_credit,wave,om,especes',
        'code_pin' => 'nullable|string|max:255',
        'mode_commande' => 'required|in:à emporter,sur place',
        'table_id' => 'nullable|exists:tables,id'
    ]);

    try {
        $restaurantId = $data['restaurant_id'];
        $cartKey = "cart_$restaurantId";
        $cart = session()->get($cartKey);

        if (empty($cart)) {
            throw new \Exception('Le panier est vide ou invalide.');
        }

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

        $plats = Plat::whereIn('id', array_keys($cart))->get();
        $totalOrderPrice = 0;

        foreach ($plats as $plat) {
            $quantity = $cart[$plat->id]['quantity'];
            $totalOrderPrice += $plat->price * $quantity;

            $detailCommande = new DetailCommande();
            $detailCommande->commande_id = $commande->id;
            $detailCommande->plat_id = $plat->id;
            $detailCommande->quantite = $quantity;
            $detailCommande->save();
        }

        $paiement = new Paiement();
        $paiement->commande_id = $commande->id;
        $paiement->montant = $totalOrderPrice;
        $paiement->date_heure = now();
        $paiement->mode_paiement = $validatedData['mode_paiement'];
        if ($validatedData['mode_paiement'] != 'especes') {
            $paiement->cc_number = $validatedData['code_pin'];
        }
        $paiement->save();

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

        session()->forget('order');
        session()->forget("cart_$restaurantId");

        return redirect()->route('serveur.commandes.create')->with('success', 'Commande enregistrée avec succès!');
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Erreur lors de l\'enregistrement de la commande: ' . $e->getMessage(),
        ]);
    }
}
}
