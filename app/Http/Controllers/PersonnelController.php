<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\NewUserCreated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class PersonnelController extends Controller
{
    // Afficher tous les utilisateurs du restaurant
    public function index()
    {
        $restaurantId = auth()->user()->restaurant_id;
        $personnel = User::where('restaurant_id', $restaurantId)->get();

        return view('personnel.index', compact('personnel'));
    }

    // Afficher le formulaire de création d'un nouvel utilisateur
    public function create()
    {
        $roles = ['admin', 'serveur', 'gérant', 'caissier', 'polyvalents', 'cuisiniers', 'barman'];
        return view('personnel.create', compact('roles'));
    }

    // Enregistrer un nouvel utilisateur
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,serveur,gérant,caissier,polyvalents,cuisiniers,barman',
        ]);

        $restaurantId = auth()->user()->restaurant_id;

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'restaurant_id' => $restaurantId,
        ]);

        Mail::to($user->email)->send(new NewUserCreated($user, $request->password));

        return redirect()->route('personnel.index')->with('success', 'Utilisateur créé avec succès.');
    }

    // Afficher le formulaire d'édition d'un utilisateur
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = ['admin', 'serveur', 'gérant', 'caissier', 'polyvalents', 'cuisiniers', 'barman'];
        return view('personnel.edit', compact('user', 'roles'));
    }

    // Mettre à jour un utilisateur existant
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|string|min:6',
            'role' => 'required|in:admin,serveur,gérant,caissier,polyvalents,cuisiniers,barman',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'role' => $request->role,
        ]);

        return redirect()->route('personnel.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    // Supprimer un utilisateur
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('personnel.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}
