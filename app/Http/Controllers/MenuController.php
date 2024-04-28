<?php
// app/Http/Controllers/MenuController.php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Plat;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        // Récupérer tous les menus
        $menus = auth()->user()->restaurant->menus;

        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        // Récupérer les plats associés au restaurant
        $plats = auth()->user()->restaurant->plats;

        return view('admin.menus.create', compact('plats'));
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
        return redirect()->route('menus.index')->with('success', 'Menu créé avec succès.');
    }

    // Autres méthodes pour edit, update et destroy
}
