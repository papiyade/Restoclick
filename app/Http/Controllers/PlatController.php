<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plat;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class PlatController extends Controller
{
    // Afficher la liste des plats de l'admin connecté
    public function index()
    {
        // Récupérer l'administrateur connecté
        $admin = Auth::user();

        // Vérifier si l'administrateur est associé à un restaurant
        if ($admin->restaurant) {
            // Si oui, récupérer les plats associés à ce restaurant
            $plats = $admin->restaurant->plats;

            // Retourner la vue avec les plats récupérés
            return view('admin.plats.index', compact('plats'));
        } else {
            // Si non, rediriger l'administrateur vers une page d'erreur ou une autre page appropriée
            return redirect()->route('admin.dashboard')->with('error', 'Vous n\'êtes pas associé à un restaurant.');
        }
    }

    // Afficher le formulaire de création d'un plat
    public function create()
    {
        // Récupérer l'ID de l'utilisateur connecté
        $userId = Auth::id();

        // Récupérer les catégories créées par l'utilisateur connecté
        $categories = Category::whereHas('restaurant', function ($query) use ($userId) {
            $query->where('admin_id', $userId);
        })->get();

        return view('admin.plats.create', compact('categories'));
    }

    // Enregistrer un nouveau plat dans la base de données
    public function store(Request $request)
{
    // Validation des données du formulaire
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'image_url' => 'nullable|url',
        'availability' => 'required|in:available,unavailable',
        'category_id' => 'required|exists:categories,id', // Validation de la catégorie
    ]);

    // Récupérer l'utilisateur connecté
    $user = Auth::user();

    // Vérifier si l'utilisateur est connecté et associé à un restaurant
    if ($user && $user->restaurant) {
        // Créer le plat associé au restaurant de l'admin
        $plat = new Plat($request->all());
        $plat->restaurant_id = $user->restaurant->id; // Associer le plat au restaurant de l'admin
        $plat->save();

        // Rediriger avec un message de succès
        return redirect()->route('admin.plats.index')->with('success', 'Plat créé avec succès.');
    } else {
        // Rediriger avec un message d'erreur
        return redirect()->route('admin.plats.index')->with('error', 'Vous devez être connecté et associé à un restaurant pour créer un plat.');
    }
}


    // Afficher le formulaire d'édition d'un plat
    public function edit(Plat $plat)
    {
        // Vérifier si le plat appartient au restaurant associé à l'admin
        if ($this->isAdminAuthorized($plat)) {
            // Récupérer l'ID du restaurant associé à l'admin connecté
            $restaurantId = Auth::user()->restaurant_id;

            // Récupérer les catégories du restaurant associé à l'admin
            $categories = Category::whereHas('restaurant', function ($query) use ($restaurantId) {
                $query->where('id', $restaurantId);
            })->get();

            return view('admin.plats.edit', compact('plat', 'categories'));
        } else {
            // Rediriger avec un message d'erreur
            return redirect()->route('admin.plats.index')->with('error', 'Vous n\'êtes pas autorisé à modifier ce plat.');
        }
    }

    // Mettre à jour un plat dans la base de données
    public function update(Request $request, Plat $plat)
    {
        // Validation des données du formulaire
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image_url' => 'nullable|url',
            'availability' => 'required|in:available,unavailable',
            // Ajoutez d'autres validations selon vos besoins
        ]);

        // Vérifier si le plat appartient au restaurant associé à l'admin
        if ($this->isAdminAuthorized($plat)) {
            // Mettre à jour les informations du plat
            $plat->update($request->all());
            // Rediriger avec un message de succès
            return redirect()->route('admin.plats.index')->with('success', 'Plat mis à jour avec succès.');
        } else {
            // Rediriger avec un message d'erreur
            return redirect()->route('admin.plats.index')->with('error', 'Vous n\'êtes pas autorisé à modifier ce plat.');
        }
    }

    // Supprimer un plat de la base de données
    public function destroy(Plat $plat)
    {
        // Vérifier si le plat appartient au restaurant associé à l'admin
        if ($this->isAdminAuthorized($plat)) {
            // Supprimer le plat
            $plat->delete();
            // Rediriger avec un message de succès
            return redirect()->route('admin.plats.index')->with('success', 'Plat supprimé avec succès.');
        } else {
            // Rediriger avec un message d'erreur
            return redirect()->route('admin.plats.index')->with('error', 'Vous n\'êtes pas autorisé à supprimer ce plat.');
        }
    }

    // Vérifier si l'admin est autorisé à modifier ou supprimer ce plat
    private function isAdminAuthorized(Plat $plat)
    {
        $restaurantId = Auth::user()->restaurant_id;
        return $plat->restaurant_id === $restaurantId;
    }
}
