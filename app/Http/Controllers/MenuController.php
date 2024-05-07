<?php
// app/Http/Controllers/MenuController.php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Plat;
use App\Models\Restaurant;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function index()
    {
        // Récupérer tous les menus
        $menus = auth()->user()->restaurant->menus;
        $userId = Auth::id();
         // Récupérer les catégories créées par l'utilisateur connecté
         $categories = Category::whereHas('restaurant', function ($query) use ($userId) {
            $query->where('admin_id', $userId);
        })->get();

        return view('admin.menus.index', compact('menus','categories'));
    }

    public function create()
    {
        // Récupérer l'utilisateur connecté
        $user = auth()->user();

        // Vérifier si l'utilisateur est associé à un restaurant
        if ($user->restaurant) {
            // Récupérer les plats associés au restaurant
            $plats = $user->restaurant->plats;

            // Récupérer les catégories associées au restaurant
            $categories = $user->restaurant->categories;

            return view('admin.menus.create', compact('plats', 'categories'));
        } else {
            // Rediriger avec un message d'erreur si l'utilisateur n'est pas associé à un restaurant
            return redirect()->route('admin.dashboard')->with('error', 'Vous n\'êtes pas associé à un restaurant.');
        }
    }


    public function store(Request $request)
    {
        // Validation des données du formulaire
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'plats' => 'required|array',
            'plats.*' => 'exists:plats,id',
        ]);

        // Créer un nouveau menu
        $menu = new Menu([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Enregistrer le menu
        auth()->user()->restaurant->menus()->save($menu);

        // Associer les plats sélectionnés au menu
        $menu->plats()->sync($request->plats);

        // Redirection avec un message de succès
        return redirect()->route('admin.menus.index')->with('success', 'Menu créé avec succès.');
    }

    // Autres méthodes pour edit, update et destroy
}
