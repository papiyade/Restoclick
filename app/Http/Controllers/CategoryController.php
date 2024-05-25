<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        // Récupérer l'administrateur connecté
        $admin = Auth::user();

        // Vérifier si l'administrateur est associé à un restaurant
        if ($admin->restaurant) {
            // Si oui, récupérer les catégories associées à ce restaurant
            $categories = $admin->restaurant->categories()->paginate(10);
            return view('admin.categories.index', compact('categories'));
        } else {
            // Si non, rediriger l'administrateur vers une page d'erreur ou une autre page appropriée
            return redirect()->route('admin.dashboard')->with('error', 'Vous n\'êtes pas associé à un restaurant.');
        }
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255'
        ]);

        $admin = Auth::user();

        if ($admin->restaurant) {
            $admin->restaurant->categories()->create($request->all());
            $message = 'Catégorie créée avec succès.';
        } else {
            $message = 'Impossible de créer la catégorie. L\'administrateur n\'est pas associé à un restaurant.';
        }

        return redirect()->route('admin.categories.index')->with('success', $message);
    }
    public function showReservations()
{
    $admin = auth()->user();
    $reservations = Reservation::where('restaurant_id', $admin->restaurant_id)->get();
    return view('admin.reservations', compact('reservations'));
}


    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        if ($this->isAdminAuthorized($category)) {
            $category->update($request->all());
            $message = 'Catégorie mise à jour avec succès.';
        } else {
            $message = 'Vous n\'êtes pas autorisé à modifier cette catégorie.';
        }

        return redirect()->route('admin.categories.index')->with('success', $message);
    }


    public function destroy(Category $category)
    {
        if ($this->isAdminAuthorized($category)) {
            $category->delete();
            $message = 'Catégorie supprimée avec succès.';
        } else {
            $message = 'Vous n\'êtes pas autorisé à supprimer cette catégorie.';
        }

        return redirect()->route('admin.categories.index')->with('success', $message);
    }

    private function isAdminAuthorized(Category $category)
    {
        $admin = Auth::user();

        if ($admin->restaurant) {
            return $admin->restaurant->id === $category->restaurant_id;
        }

        return false;
    }
}
