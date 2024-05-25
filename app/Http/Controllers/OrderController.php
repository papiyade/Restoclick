<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;
use App\Models\DetailCommande;
use App\Models\Plat;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function addToCart(Request $request, $platId)
    {
        $plat = Plat::find($platId);
        $quantity = $request->input('quantity', 1);

        // Ajouter le plat au panier (en session)
        $cart = session()->get('cart', []);
        $cart[$platId] = [
            'plat' => $plat,
            'quantity' => $quantity
        ];
        session()->put('cart', $cart);

        return redirect()->route('client.menu');
    }

    public function showCart()
    {
        $cart = session()->get('cart', []);
        return view('client.cart', compact('cart'));
    }

    public function placeOrder(Request $request)
    {
        $cart = session()->get('cart', []);
        $client = Auth::user();

        if (empty($cart)) {
            return redirect()->route('client.menu')->with('error', 'Votre panier est vide.');
        }

        // Créer une nouvelle commande
        $commande = new Commande();
        $commande->client_id = $client->id;
        $commande->serveur_id = null; // Assigné plus tard par l'administrateur
        $commande->table_id = $request->input('table_id'); // Assurez-vous que le client a sélectionné une table
        $commande->statut = 'en_cours';
        $commande->save();

        // Créer les détails de la commande
        foreach ($cart as $platId => $item) {
            DetailCommande::create([
                'commande_id' => $commande->id,
                'plat_id' => $platId,
                'quantite' => $item['quantity']
            ]);
        }

        // Vider le panier
        session()->forget('cart');

        return redirect()->route('client.menu')->with('success', 'Votre commande a été passée avec succès.');
    }
}
