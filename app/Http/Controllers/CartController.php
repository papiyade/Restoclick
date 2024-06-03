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

        $cart = session()->get('cart', []);
        if (isset($cart[$platId])) {
            $cart[$platId]++;
        } else {
            $cart[$platId] = 1;
        }
        session()->put('cart', $cart);

        return response()->json(['success' => true]);
    }

    public function seeShop($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $categories = Category::where('restaurant_id', $id)->with('plats')->get();
        $cart = session()->get('cart', []);

        // Fetch plats in the cart
        $plats = Plat::whereIn('id', array_keys($cart))->get();

        // Calculate the subtotal
        $subtotal = $plats->reduce(function ($carry, $plat) use ($cart) {
            return $carry + ($plat->price * $cart[$plat->id]);
        }, 0);

        return view('Shop', compact('categories', 'restaurant', 'cart', 'subtotal'));
    }

    public function getCart()
    {
        $cart = session()->get('cart', []);
        $plats = Plat::whereIn('id', array_keys($cart))->get();

        $view = view('partials.cart-items', compact('plats', 'cart'))->render();
        return response()->json(['html' => $view]);
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
        }
        session()->put('cart', $cart);

        return response()->json(['success' => true]);
    }
}
