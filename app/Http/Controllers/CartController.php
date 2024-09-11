<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Category;
use App\Models\Plat;
use Illuminate\Http\Request;
use App\Models\Table;
use Cart;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $platId = $request->input('plat_id');
        $restaurantId = $request->input('restaurant_id');
        $quantity = $request->input('quantity', 1);

        $cartKey = "cart_$restaurantId";
        $cart = session()->get($cartKey, []);

        if (isset($cart[$platId])) {
            $cart[$platId]['quantity'] += $quantity;
        } else {
            $plat = Plat::find($platId);

            if ($plat) {
                $cart[$platId] = [
                    'name' => $plat->name,
                    'price' => $plat->price,
                    'quantity' => $quantity,
                    'restaurant_id' => $restaurantId,
                    'image_url' => $plat->image_url,
                    'description' => $plat->description, // Ajouter cette ligne

                ];
            }
        }

        session()->put($cartKey, $cart);

        $totalQuantity = array_sum(array_column($cart, 'quantity'));

        return response()->json(['cartCount' => $totalQuantity, 'restaurantId' => $restaurantId]);
    }

    public function deleteCartItem(Request $request)
    {
        $platId = $request->input('plat_id');
        $restaurantId = $request->input('restaurant_id');

        $cartKey = "cart_$restaurantId";
        $cart = session()->get($cartKey, []);

        if (isset($cart[$platId])) {
            unset($cart[$platId]);
            session()->put($cartKey, $cart);
        }

        $totalQuantity = array_sum(array_column($cart, 'quantity'));

        return response()->json(['cartCount' => $totalQuantity, 'restaurantId' => $restaurantId]);
    }

    public function showCart($restaurantId)
    {
        $cartKey = "cart_$restaurantId";
        $cart = session()->get($cartKey, []);
        $restaurant = Restaurant::findOrFail($restaurantId);

        return view('cart', ['cart' => $cart, 'restaurant' => $restaurant, 'restaurantId' => $restaurantId]);
    }

    public function updateCartQuantity(Request $request)
    {
        $platId = $request->input('id');
        $restaurantId = $request->input('restaurant_id');
        $quantityChange = $request->input('quantity');

        $cartKey = "cart_$restaurantId";
        $cart = session()->get($cartKey, []);

        if (isset($cart[$platId])) {
            $cart[$platId]['quantity'] += $quantityChange;

            if ($cart[$platId]['quantity'] <= 0) {
                unset($cart[$platId]);
            }

            session()->put($cartKey, $cart);
        }

        return response()->json(['success' => true]);
    }
    public function checkout($restaurantId)
    {
        $cartKey = "cart_$restaurantId";
        $cart = session()->get($cartKey, []);

        // Vérifiez si $cart est vide ou non défini
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Votre panier est vide.');
        }

        // Récupérez les plats correspondants aux ID dans le panier
        $plats = Plat::whereIn('id', array_keys($cart))->get();

        // Ajoutez les quantités choisies à chaque plat
        foreach ($plats as $plat) {
            $plat->quantity = $cart[$plat->id]['quantity'];
        }

        // Calculer le total de la commande
        $totalOrderPrice = 0;
        foreach ($plats as $plat) {
            $totalOrderPrice += $plat->price * $plat->quantity;
        }

        // Récupérez le restaurant correspondant à $restaurantId
        $restaurant = Restaurant::find($restaurantId);

        if (!$restaurant) {
            // Gérer le cas où aucun restaurant correspondant n'est trouvé
            return redirect()->back()->with('error', 'Restaurant non trouvé.');
        }

        // Récupérer les tables disponibles pour le restaurant
        $tables = Table::where('restaurant_id', $restaurantId)->where('statut', 'disponible')->get();

        return view('checkout', [
            'cartItems' => $plats, // Passer les plats avec les quantités choisies
            'totalPrice' => $totalOrderPrice, // Total de la commande
            'cart' => $cart, // Passer le panier à la vue
            'restaurantId' => $restaurantId, // Passer l'ID du restaurant à la vue
            'restaurant' => $restaurant, // Passer le restaurant à la vue
            'tables' => $tables, // Passer les tables disponibles à la vue
        ]);
    }



    public function getCartDetails()
    {
        $cartItems = Cart::getContent();
        return view('cart-details', compact('cartItems'));
    }



  

    public function getCartContent()
    {
        $restaurantId = session('restaurant_id');
        $cartItems = Cart::with('plat')->where('restaurant_id', $restaurantId)->get();

        return view('partials.cart-items', compact('cartItems'));
    }

    public function removeFromCart(Request $request)
    {
        $platId = $request->input('plat_id');
        $restaurantId = $request->input('restaurant_id');

        $cart = session()->get("cart_$restaurantId", []);
        if (isset($cart[$platId])) {
            unset($cart[$platId]);
        }
        session()->put("cart_$restaurantId", $cart);

        return response()->json(['success' => true]);
    }

    public function initiateOrder(Request $request)
    {
        // Valider les données de la commande ici ou les passer directement à la méthode commander
        $orderController = new OrderController();
        return $orderController->commander($request);
    }
}
