<?php
// app/Http/Controllers/MenuController.php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Plat;
use App\Models\Restaurant;
use App\Models\Category;
use App\Models\User;
use App\Models\Reservation;
use App\Models\Table;
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
    public function showReservationsForm()
    {
        $tables = Table::where('statut', 'disponible')->get();
        return view('client.reservation', compact('tables'));
    }

    public function makeReservation(Request $request)
    {
        // Ajouter des règles de validation
        $request->validate([
            'table_id' => 'required|exists:tables,id',
            'date_heure' => 'required|date|after:now',
        ]);

        // Vérifier si l'utilisateur est authentifié
        if (!Auth::check()) {
            return redirect()->route('client.reservation')->withErrors('Vous devez être connecté pour faire une réservation.');
        }

        $client = Auth::user();
        $tableId = $request->input('table_id');
        $dateHeure = $request->input('date_heure');

        try {
            // Créer la réservation
            Reservation::create([
                'client_id' => $client->id,
                'table_id' => $tableId,
                'date_heure' => $dateHeure,
            ]);

            return redirect()->route('client.reservation.form')->with('success', 'Votre réservation a été effectuée avec succès.');
        } catch (\Exception $e) {
            // Enregistrer l'erreur dans les logs
            Log::error('Erreur lors de la création de la réservation : ' . $e->getMessage());

            return redirect()->route('client.reservation.form')->withErrors('Une erreur est survenue lors de la création de votre réservation. Veuillez réessayer.');
        }
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
            'prix' => 'nullable|numeric|min:0',
            'plats' => 'required|array',
            'plats.*' => 'exists:plats,id',
        ]);

        // Créer un nouveau menu
        $menu = new Menu([
            'name' => $request->name,
            'description' => $request->description,
            'prix' =>  $request->prix,
        ]);

        // Enregistrer le menu
        auth()->user()->restaurant->menus()->save($menu);

        // Associer les plats sélectionnés au menu
        $menu->plats()->sync($request->plats);

        // Redirection avec un message de succès
        return redirect()->route('admin.menus.index')->with('success', 'Menu créé avec succès.');
    }

    public function edit(Menu $menu)
{
    // Récupérer l'utilisateur connecté
    $user = auth()->user();

    // Vérifier si l'utilisateur est associé à un restaurant
    if ($user->restaurant) {
        // Récupérer les plats associés au restaurant
        $plats = $user->restaurant->plats;

        // Récupérer les catégories associées au restaurant
        $categories = $user->restaurant->categories;

        return view('admin.menus.edit', compact('menu', 'plats', 'categories'));
    } else {
        // Rediriger avec un message d'erreur si l'utilisateur n'est pas associé à un restaurant
        return redirect()->route('admin.dashboard')->with('error', 'Vous n\'êtes pas associé à un restaurant.');
    }
}

public function update(Request $request, Menu $menu)
{
    // Validation des données du formulaire
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'plats' => 'required|array',
        'plats.*' => 'exists:plats,id',
    ]);

    // Mettre à jour les données du menu
    $menu->update([
        'name' => $request->name,
        'description' => $request->description,
    ]);

    // Associer les plats sélectionnés au menu
    $menu->plats()->sync($request->plats);

    // Redirection avec un message de succès
    return redirect()->route('admin.menus.index')->with('success', 'Menu mis à jour avec succès.');
}
public function showMenu()
{
    $categories = Category::with('plats')->get(); // Supposons que le modèle Category a une relation 'plats'
    return view('front-menu', compact('categories'));
}


public function destroy(Menu $menu)
{
    // Supprimer le menu
    $menu->delete();

    // Redirection avec un message de succès
    return redirect()->route('admin.menus.index')->with('success', 'Menu supprimé avec succès.');
}

    // Autres méthodes pour edit, update et destroy
}
