<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;
use Illuminate\Support\Facades\Auth;

class TableController extends Controller
{
    // Afficher la liste des tables
    public function index()
    {
        $admin = Auth::user();

        if ($admin && $admin->restaurant) {
            $tables = $admin->restaurant->tables;
            return view('admin.tables.index', compact('tables'));
        } else {
            return redirect()->route('admin.dashboard')->with('error', 'Vous n\'êtes pas associé à un restaurant.');
        }
    }

    // Afficher le formulaire de création d'une table
    public function create()
    {
        return view('admin.tables.create');
    }

    // Enregistrer une nouvelle table dans la base de données
    public function store(Request $request)
    {
        $request->validate([
            'numero_table' => 'required|string|max:255',
            'qr_code' => 'nullable|string|max:255',
            'statut' => 'required|in:occupee,disponible',
        ]);

        $admin = Auth::user();

        if ($admin && $admin->restaurant) {
            $table = new Table($request->all());
            $table->restaurant_id = $admin->restaurant->id;
            $table->save();

            return redirect()->route('admin.tables.index')->with('success', 'Table créée avec succès.');
        } else {
            return redirect()->route('admin.tables.index')->with('error', 'Vous devez être associé à un restaurant pour créer une table.');
        }
    }

    // Afficher le formulaire de modification d'une table
    public function edit(Table $table)
    {
        $admin = Auth::user();
        if ($admin && $admin->restaurant && $admin->restaurant->id == $table->restaurant_id) {
            return view('admin.tables.edit', compact('table'));
        } else {
            return redirect()->route('admin.tables.index')->with('error', 'Vous n\'êtes pas autorisé à modifier cette table.');
        }
    }

    // Mettre à jour une table dans la base de données
    public function update(Request $request, Table $table)
    {
        $request->validate([
            'numero_table' => 'required|string|max:255',
            'qr_code' => 'nullable|string|max:255',
            'statut' => 'required|in:occupee,disponible',
        ]);

        $admin = Auth::user();
        if ($admin && $admin->restaurant && $admin->restaurant->id == $table->restaurant_id) {
            $table->update($request->all());
            return redirect()->route('admin.tables.index')->with('success', 'Table mise à jour avec succès.');
        } else {
            return redirect()->route('admin.tables.index')->with('error', 'Vous n\'êtes pas autorisé à mettre à jour cette table.');
        }
    }

    // Supprimer une table de la base de données
    public function destroy(Table $table)
    {
        $admin = Auth::user();
        if ($admin && $admin->restaurant && $admin->restaurant->id == $table->restaurant_id) {
            $table->delete();
            return redirect()->route('admin.tables.index')->with('success', 'Table supprimée avec succès.');
        } else {
            return redirect()->route('admin.tables.index')->with('error', 'Vous n\'êtes pas autorisé à supprimer cette table.');
        }
    }
}
