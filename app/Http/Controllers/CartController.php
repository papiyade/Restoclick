<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Category;
use App\Models\Plat;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $platId = $request->input('plat_id');
        $restaurantId = $request->input('restaurant_id');

        $cart = session()->get("cart_$restaurantId", []);
        if (isset($cart[$platId])) {
            $cart[$platId]++;
        } else {
            $cart[$platId] = 1;
        }
        session()->put("cart_$restaurantId", $cart);

        return response()->json(['success' => true, 'cartCount' => array_sum($cart)]);
    }

    public function seeShop($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $categories = Category::where('restaurant_id', $id)->with('plats')->get();
        $cart = session()->get("cart_$id", []);

        $plats = Plat::whereIn('id', array_keys($cart))->get();
        $subtotal = $plats->reduce(function ($carry, $plat) use ($cart) {
            return $carry + ($plat->price * $cart[$plat->id]);
        }, 0);

        return view('Shop', compact('categories', 'restaurant', 'cart', 'subtotal'));
    }

    public function getCart($restaurantId)
    {
        $cart = session()->get("cart_$restaurantId", []);
        $plats = Plat::whereIn('id', array_keys($cart))->get();

        $view = view('partials.cart-items', compact('plats', 'cart'))->render();
        return response()->json(['html' => $view]);
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

}
