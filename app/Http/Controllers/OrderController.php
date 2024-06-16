<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Plat;
use App\Models\DetailCommande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
{
    // Validation des données du formulaire
    $validatedData = $request->validate([
        'client_name' => 'required|string|max:255',
        'telephone_client' => 'required|numeric',
        'restaurant_id' => 'required|integer',
        'cart' => 'required|array',
        'cart.*.plat_id' => 'required|integer',
        'cart.*.quantity' => 'required|integer|min:1',
    ]);

    // Création de la commande
    $commande = new Commande();
    $commande->client_name = $validatedData['client_name'];
    $commande->telephone_client = $validatedData['telephone_client'];
    $commande->restaurant_id = $validatedData['restaurant_id'];
    $commande->save();

    // Ajout des détails de la commande
    foreach ($validatedData['cart'] as $item) {
        $detail = new DetailCommande();
        $detail->commande_id = $commande->id;
        $detail->plat_id = $item['plat_id'];
        $detail->quantite = $item['quantity'];
        $detail->save();
    }
    

    return response()->json(['success' => true, 'message' => 'Commande passée avec succès.']);
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
        $query = $request->input('searche');

        if ($query) {
            $commandes = Commande::where('restaurant_id', $admin->restaurant_id)
                                        ->where('client_name', 'LIKE', "%{$query}%")
                                        ->paginate(5);
        } else {
            $commandes = Commande::where('restaurant_id', $admin->restaurant_id)
                                        ->paginate(5);
        }

        Log::info("Admin ID: {$admin->id}, Restaurant ID: {$admin->restaurant_id}, Reservations Count: " . $commandes->total());
    } else {
        $commandes = collect(); // Aucun résultat
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
        'html' => view('admin.commandes.details', compact('commande','totalPrice'))->render()
    ]);
}

// public function show($id)
// {
//     $commande = Commande::findOrFail($id);
//     $commande->load('details.plat'); // Chargement des détails de la commande avec les plats associés
//     return view('admin.commandes.details', compact('commande'));
// }



}
