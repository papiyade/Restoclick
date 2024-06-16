<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminAssignedToRestaurant;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::with('admin')->get();
        return view('superadmin.restaurants.index', compact('restaurants'));
    }

    public function create()
    {
        $admins = User::where('role', 'admin')->get();
        return view('superadmin.restaurants.create', compact('admins'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'phone_number' => 'required|string',
            'email' => 'required|email',
            'admin_id' => 'required|exists:users,id',
        ]);

        $restaurant = Restaurant::create([
            'name' => $validatedData['name'],
            'address' => $validatedData['address'],
            'phone_number' => $validatedData['phone_number'],
            'email' => $validatedData['email'],
            'admin_id' => $validatedData['admin_id'],
        ]);

        $admin = User::findOrFail($request->admin_id);
        $admin->restaurant_id = $restaurant->id;
        $admin->save();

        // Envoi d'un email à l'administrateur
        Mail::to($admin->email)->send(new AdminAssignedToRestaurant($admin, $restaurant));

        return redirect()->route('superadmin.restaurants.index')->with('success', 'Restaurant ajouté avec succès');
    }

    public function show(string $id)
    {
        //
    }

    public function edit($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        return view('superadmin.restaurants.edit', compact('restaurant'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'phone_number' => 'required|string',
            'email' => 'required|email',
        ]);

        $restaurant = Restaurant::findOrFail($id);
        $restaurant->update($validatedData);

        return redirect()->route('superadmin.restaurants.index')->with('success', 'Restaurant modifié avec succès');
    }

    public function destroy($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->delete();

        return redirect()->route('superadmin.restaurants.index')->with('success', 'Restaurant supprimé avec succès.');
    }
}
