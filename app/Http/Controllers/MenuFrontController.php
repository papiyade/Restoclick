<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MenuFrontController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function showMenu()
    {
        // Récupérer tous les menus pour l'utilisateur connecté
        $menus = auth()->user()->restaurant->menus;
        $lastMenu = $menus->last();
        $userId = Auth::id();

        // Récupérer les catégories créées par l'utilisateur connecté
        $categories = Category::whereHas('restaurant', function ($query) use ($userId) {
            $query->where('admin_id', $userId);
        })->get();

        // Passer les variables à la vue
        return view('front-menu', compact('lastMenu', 'categories'));
    }
    public function showthatMenu()
    {
        // Récupérer tous les menus pour l'utilisateur connecté
        $menus = auth()->user()->restaurant->menus;
        $lastMenu = $menus->last();
        $userId = Auth::id();

        // Récupérer les catégories créées par l'utilisateur connecté
        $categories = Category::whereHas('restaurant', function ($query) use ($userId) {
            $query->where('admin_id', $userId);
        })->get();
        return view('Resto', compact('lastMenu', 'categories'));
    }

    public function showMenuById($id)
    {
        // Récupérer le restaurant par son ID
        $restaurant = Restaurant::findOrFail($id);

        // Récupérer les menus et le dernier menu du restaurant
        $menus = $restaurant->menus;
        $lastMenu = $menus->last();

        // Récupérer les catégories associées à ce restaurant
        $categories = Category::where('restaurant_id', $id)->get();

        // Passer les variables à la vue
        return view('front-menu', compact('lastMenu', 'categories', 'restaurant'));
    }

    public function showMenuParId($id){
        $restaurant = Restaurant::findOrFail($id);

    // Récupérer les menus et le dernier menu du restaurant
    $menus = $restaurant->menus;
    $lastMenu = $menus->last();

    // Récupérer les catégories associées aux plats du dernier menu
    $categories = $lastMenu ? Category::whereIn('id', $lastMenu->plats->pluck('category_id'))->get() : collect();

    return view('Resto', compact('lastMenu', 'categories', 'restaurant'));


    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
