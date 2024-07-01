<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PanierController extends Controller
{
    /**
     * Affiche le contenu du panier.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Récupérer le panier depuis localStorage
        $cart = json_decode(request()->cookie('cart'), true) ?? [];

        // Faire quelque chose avec le panier si nécessaire

        return view('panier.index', compact('cart'));
    }

    /**
     * Ajoute un plat au panier.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $platId = $request->input('plat_id');
        $restaurantId = $request->input('restaurant_id');
        $quantity = $request->input('quantity', 1);

        // Récupérer le panier depuis localStorage
        $cart = json_decode($request->cookie('cart'), true) ?? [];

        // Vérifier si le plat est déjà dans le panier
        $index = $this->getCartItemIndex($cart, $platId, $restaurantId);

        if ($index !== false) {
            // Si le plat existe déjà, incrémenter la quantité
            $cart[$index]['quantity'] += $quantity;
        } else {
            // Sinon, ajouter le plat au panier
            $cart[] = [
                'plat_id' => $platId,
                'restaurant_id' => $restaurantId,
                'quantity' => $quantity,
            ];
        }

        // Mettre à jour le cookie du panier
        return response()->json(['success' => true])->cookie('cart', json_encode($cart), 60 * 24 * 7); // 1 semaine d'expiration
    }

    /**
     * Supprime un plat du panier.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $platId = $request->input('plat_id');
        $restaurantId = $request->input('restaurant_id');

        // Récupérer le panier depuis localStorage
        $cart = json_decode($request->cookie('cart'), true) ?? [];

        // Trouver l'index du plat dans le panier
        $index = $this->getCartItemIndex($cart, $platId, $restaurantId);

        if ($index !== false) {
            // Supprimer l'élément du panier
            array_splice($cart, $index, 1);
        }

        // Mettre à jour le cookie du panier
        return response()->json(['success' => true])->cookie('cart', json_encode($cart), 60 * 24 * 7); // 1 semaine d'expiration
    }

    /**
     * Retourne l'index d'un plat dans le panier, ou false s'il n'est pas trouvé.
     *
     * @param  array  $cart
     * @param  int  $platId
     * @param  int  $restaurantId
     * @return int|false
     */
    private function getCartItemIndex($cart, $platId, $restaurantId)
    {
        foreach ($cart as $index => $item) {
            if ($item['plat_id'] == $platId && $item['restaurant_id'] == $restaurantId) {
                return $index;
            }
        }

        return false;
    }
}
