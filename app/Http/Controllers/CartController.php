<?php

namespace App\Http\Controllers;
use App\Models\Restaurant;
use App\Models\Category;

use Illuminate\Http\Request;

class CartController extends Controller
{
    // //
    // public function addToCart(Request $request)
    // {
    //     $platId = $request->input('plat_id');
    //     // Logique pour ajouter le plat au panier
    //     // Vous pouvez sauvegarder le panier en session ou dans la base de données

    //     return response()->json(['success' => true]);
    // }

    public function addToCart(Request $request)
    {
        $platId = $request->input('plat_id');

        // Logique pour ajouter le plat au panier
        // Vous pouvez sauvegarder le panier en session ou dans la base de données

        // Exemple de sauvegarde en session
        $cart = session()->get('cart', []);
        if (isset($cart[$platId])) {
            $cart[$platId]++;
        } else {
            $cart[$platId] = 1;
        }
        session()->put('cart', $cart);

        return response()->json(['success' => true]);
    }

//     public function seeShop($id)
// {
//     // Récupérer le restaurant par son ID
//     $restaurant = Restaurant::findOrFail($id);

//     // Récupérer les menus et le dernier menu du restaurant
//     $menus = $restaurant->menus;
//     $lastMenu = $menus->last();

//     // Récupérer les catégories associées à ce restaurant
//     $categories = Category::where('restaurant_id', $id)->get();

//     // Récupérer le panier depuis la session
//     $cart = session()->get('cart', []);

//     // Passer les variables à la vue
//     return view('Shop', compact('lastMenu', 'categories', 'restaurant', 'cart'));
// }

public function seeShop($id)
{
    // Récupérer le restaurant par son ID
    $restaurant = Restaurant::findOrFail($id);

    // Récupérer les catégories associées à ce restaurant
    $categories = Category::where('restaurant_id', $id)->with('plats')->get();

    // Récupérer le panier depuis la session
    $cart = session()->get('cart', []);

    // Passer les variables à la vue
    return view('Shop', compact('categories', 'restaurant', 'cart'));
}



public function getCart()
{
    $cart = session()->get('cart');
    $view = view('partials.cart-items', compact('cart'))->render();

    return response()->json(['html' => $view]);
}



    }

