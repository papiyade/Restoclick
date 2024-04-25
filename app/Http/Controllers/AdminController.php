<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    // Afficher tous les utilisateurs
    public function index()
    {
        $users = User::where('role', 'admin')->get();
$restaurants = Restaurant::all();
return view('superadmin.users.index', compact('users', 'restaurants', ));

    }

    // Afficher le formulaire de création d'utilisateur
    public function create()
    {
        return view('superadmin.users.create');
    }

    // Enregistrer un nouvel utilisateur dans la base de données
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'admin',
        ]);

        return redirect()->route('superadmin.users.index')->with('success', 'Utilisateur créé avec succès.');
    }

    // Afficher les détails d'un utilisateur spécifique
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('superadmin.users.show', compact('user'));
    }

    // Afficher le formulaire de modification d'utilisateur
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('superadmin.users.edit', compact('user'));
    }

    // Mettre à jour les informations d'un utilisateur dans la base de données
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|string|min:6',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return redirect()->route('superadmin.users.index')->with('success', 'Informations utilisateur mises à jour avec succès.');
    }

    // Supprimer un utilisateur de la base de données
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('superadmin.users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}
