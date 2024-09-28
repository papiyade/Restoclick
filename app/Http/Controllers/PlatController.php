<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plat;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PlatController extends Controller
{
    // Afficher la liste des plats de l'admin connecté
    public function index()
    {
        // Récupérer l'utilisateur connecté
        $admin = Auth::user();

        // Vérifier si un utilisateur est connecté
        if ($admin) {
            // Vérifier si l'utilisateur est associé à un restaurant
            if ($admin->restaurant) {
                // Si oui, récupérer les plats associés à ce restaurant
                $plats = $admin->restaurant->plats;

                // Retourner la vue avec les plats récupérés
                return view('admin.plats.index', compact('plats'));
            } else {
                // Si non, rediriger l'administrateur vers une page d'erreur ou une autre page appropriée
                return redirect()->route('admin.dashboard')->with('error', 'Vous n\'êtes pas associé à un restaurant.');
            }
        } else {
            // Si aucun utilisateur n'est connecté, rediriger vers la page de connexion
            return redirect()->route('login')->with('error', 'Veuillez vous connecter pour accéder à cette page.');
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

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'availability' => 'required|in:available,unavailable',
            'category_id' => 'required|exists:categories,id',
            'preparation_time' => 'nullable|integer|min:1',

        ]);

        $user = Auth::user();

        // Vérifier si l'utilisateur est connecté et associé à un restaurant
        if ($user && $user->restaurant) {
            // Créer le plat associé au restaurant de l'admin
            $plat = new Plat($request->all());

            // Traitement de l'image
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('images', 'public');
                $plat->image_url = $imagePath;
            }

            $plat->restaurant_id = $user->restaurant->id;

            $plat->save();

            return redirect()->route('admin.plats.index')->with('success', 'Plat créé avec succès.');
        } else {
            // Rediriger avec un message d'erreur
            return redirect()->route('admin.plats.index')->with('error', 'Vous devez être connecté et associé à un restaurant pour créer un plat.');
        }
    }

    public function edit(Plat $plat)
    {
        $user = auth()->user();
        $userId = Auth::id();
        $plat->restaurant_id = $user->restaurant->id;

        // Vérifier si l'administrateur est autorisé à modifier ce plat
        $categories = Category::whereHas('restaurant', function ($query) use ($userId) {
            $query->where('admin_id', $userId);
        })->get();

        return view('admin.plats.edit', compact('plat', 'categories'));
    }

    public function update(Request $request, Plat $plat)
    {
        // Validation des données du formulaire
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation de l'image
            'availability' => 'required|in:available,unavailable',
            'category_id' => 'required|exists:categories,id', // Validation de la catégorie
            'preparation_time' => 'nullable|integer|min:1', // Validation du champ preparation_time

        ]);

        // Traitement de l'image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $validatedData['image_url'] = $imagePath;
        }

        // Mettre à jour les informations du plat
        $plat->update($validatedData);

        // Redirection avec un message de succès
        return redirect()->route('admin.plats.index')->with('success', 'Plat mis à jour avec succès.');
    }

    public function trierPlats(Request $request)
    {
        // Récupérer le critère de tri depuis la requête
        $critereTri = $request->input('tri');

        // Récupérer l'ID de l'utilisateur connecté
        $userId = Auth::id();

        // Récupérer les plats associés au restaurant de l'administrateur connecté
        $plats = Plat::whereHas('restaurant', function ($query) use ($userId) {
            $query->where('admin_id', $userId);
        });

        // Appliquer le tri en fonction du critère sélectionné
        if ($critereTri === 'nom') {
            $plats->orderBy('name');
        } elseif ($critereTri === 'prix') {
            $plats->orderBy('price');
        } elseif ($critereTri === 'disponibilite') {
            $plats->orderBy('availability');
        }

        // Récupérer les plats triés
        $plats = $plats->get();

        // Retourner la vue avec les plats triés
        return view('admin.plats.index', compact('plats'));
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

