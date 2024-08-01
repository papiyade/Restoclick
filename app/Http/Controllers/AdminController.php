<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewUserCreated;
use App\Models\Commande;
use App\Models\Reservation;

class AdminController extends Controller
{
    // Afficher tous les utilisateurs
    public function index()
    {
        $users = User::where('role', '!=', 'superadmin')->get();
        $userCount = $users->count();
        $restoCount = Restaurant::count();
        $restaurants = Restaurant::all();
        $orderCount = Commande::count();
        $reservationCount = Reservation::count();

        return view('superadmin.users.index', compact('users', 'restaurants', 'userCount', 'restoCount', 'orderCount', 'reservationCount'));
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

        // Création de l'utilisateur
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'admin',
        ]);

        // Envoi d'un email au nouvel utilisateur
        Mail::to($request->email)->send(new NewUserCreated($user, $request->password));

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
            'email' => 'required|email|unique:users,email,' . $id,
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
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('superadmin.users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
    // Dans votre contrôleur
    public function dashboard()
    {
        // Récupérer les commandes associées à l'utilisateur connecté (administrateur du restaurant)
        $restaurantId = auth()->user()->restaurant->id;
        $commandes = Commande::where('restaurant_id', $restaurantId)->get();

        // Compter les commandes par statut
        $statuts = [
            'En cours' => $commandes->where('statut', 'En cours')->count(),
            'Terminée' => $commandes->where('statut', 'Terminée')->count(),
            'Annulée' => $commandes->where('statut', 'Annulée')->count(),
        ];

        return view('dashboard', compact('statuts'));
    }



    public function indexServeurs()
    {
        $serveurs = User::where('role', 'serveur')
            ->where('restaurant_id', auth()->user()->restaurant->id)
            ->get();

        return view('serveur.index', compact('serveurs'));
    }

    // Afficher le formulaire de création de serveur
    public function createServeur()
    {
        return view('serveur.create');
    }

    // Enregistrer un nouveau serveur dans la base de données
    public function storeServeur(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        // Création du serveur
        $serveur = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'restaurant_id' => auth()->user()->restaurant->id,
            'role' => 'serveur',
        ]);

        // Envoi d'un email au nouveau serveur
        Mail::to($request->email)->send(new NewUserCreated($serveur, $request->password));

        return redirect()->route('serveurs.index')->with('success', 'Serveur créé avec succès.');
    }

    // Afficher les détails d'un serveur spécifique
    public function showServeur($id)
    {
        $serveur = User::where('id', $id)
            ->where('role', 'serveur')
            ->where('restaurant_id', auth()->user()->restaurant->id)
            ->firstOrFail();

        return view('serveur.show', compact('serveur'));
    }

    // Afficher le formulaire de modification de serveur
    public function editServeur($id)
    {
        $serveur = User::where('id', $id)
            ->where('role', 'serveur')
            ->where('restaurant_id', auth()->user()->restaurant->id)
            ->firstOrFail();

        return view('serveur.edit', compact('serveur'));
    }

    // Mettre à jour les informations d'un serveur dans la base de données
    public function updateServeur(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
        ]);

        $serveur = User::where('id', $id)
            ->where('role', 'serveur')
            ->where('restaurant_id', auth()->user()->restaurant->id)
            ->firstOrFail();

        $serveur->name = $request->name;
        $serveur->email = $request->email;
        if ($request->password) {
            $serveur->password = bcrypt($request->password);
        }
        $serveur->save();

        return redirect()->route('serveurs.index')->with('success', 'Informations serveur mises à jour avec succès.');
    }

    // Supprimer un serveur
    public function destroyServeur($id)
    {
        $serveur = User::where('id', $id)
            ->where('role', 'serveur')
            ->where('restaurant_id', auth()->user()->restaurant->id)
            ->firstOrFail();

        $serveur->delete();

        return redirect()->route('serveurs.index')->with('success', 'Serveur supprimé avec succès.');
    }


    public function indexCuisiniers()
    {
        $cuisiniers = User::where('role', 'cuisinier')
            ->where('restaurant_id', auth()->user()->restaurant->id)
            ->get();
        return view('cuisinier.index', compact('cuisiniers'));
    }

    public function createCuisinier()
    {
        return view('cuisinier.create');
    }

    public function storeCuisinier(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        // Création du serveur
        $cuisinier = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'restaurant_id' => auth()->user()->restaurant->id,
            'role' => 'cuisinier',
        ]);

        // Envoi d'un email au nouveau serveur
        Mail::to($request->email)->send(new NewUserCreated($cuisinier, $request->password));

        return redirect()->route('cuisinier.index')->with('success', 'Cuisinier créé avec succès.');
    }

    public function showCuisinier($id)
    {
        $cuisinier = User::where('id', $id)
            ->where('role', 'cuisinier')
            ->where('restaurant_id', auth()->user()->restaurant->id)
            ->firstOrFail();

        return view('cuisinier.show', compact('cuisinier'));
    }

    public function editCuisinier($id)
    {
        $cuisinier = User::where('id', $id)
            ->where('role', 'cuisinier')
            ->where('restaurant_id', auth()->user()->restaurant->id)
            ->firstOrFail();

        return view('cuisinier.edit', compact('cuisinier'));

    }

    public function updateCuisinier(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
        ]);

        $cuisinier = User::where('id', $id)
            ->where('role', 'cuisinier')
            ->where('restaurant_id', auth()->user()->restaurant->id)
            ->firstOrFail();

        $cuisinier->name = $request->name;
        $cuisinier->email = $request->email;
        if ($request->password) {
            $cuisinier->password = bcrypt($request->password);
        }
        $cuisinier->save();

        return redirect()->route('cuisiniers.index')->with('success', 'Informations cuisinier mises à jour avec succès.');
    }

    public function destroyCuisinier($id)
    {
        $cuisinier = User::where('id', $id)
                        ->where('role', 'cuisinier')
                        ->where('restaurant_id', auth()->user()->restaurant->id)
                        ->firstOrFail();
        $cuisinier->delete();
        return redirect()->route('cuisinier.index')->with('success','Cuisinier supprimé avec succès');
    }
}
