<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminAssignedToRestaurant;
use App\Models\Plat;
use App\Models\Menu;

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
            'opening_time' => 'nullable|date_format:H:i',
            'closing_time' => 'nullable|date_format:H:i',
        ]);

        $restaurant = Restaurant::create([
            'name' => $validatedData['name'],
            'address' => $validatedData['address'],
            'phone_number' => $validatedData['phone_number'],
            'email' => $validatedData['email'],
            'admin_id' => $validatedData['admin_id'],
            'opening_time' => $validatedData['opening_time'],
            'closing_time' => $validatedData['closing_time']
        ]);

        $admin = User::findOrFail($request->admin_id);
        $admin->restaurant_id = $restaurant->id;
        $admin->save();

        // Envoi d'un email à l'administrateur
        Mail::to($admin->email)->send(new AdminAssignedToRestaurant($admin, $restaurant));

        return redirect()->route('superadmin.restaurants.index')->with('success', 'Restaurant ajouté avec succès');
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
            'opening_time' => 'nullable|date_format:H:i',
            'closing_time' => 'nullable|date_format:H:i',
        ]);

        $restaurant = Restaurant::findOrFail($id);
        $restaurant->update($validatedData);

        return redirect()->route('superadmin.restaurants.index')->with('success', 'Restaurant modifié avec succès');
    }

    public function showAllRestaurants()
{
    $restaurants = Restaurant::all();
    $menus = Menu::with('plats.restaurant')->get();
    return view('webmaster-resto', compact('restaurants', 'menus'));
}


    public function show($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        return view('restaurant.show', compact('restaurant'));
    }
    public function showeMenuParId($id){
        $restaurant = Restaurant::findOrFail($id);
        $menus = $restaurant->menus;
        $lastMenu = $menus->last();

        $categories = $lastMenu ? Category::whereIn('id', $lastMenu->plats->pluck('category_id'))->get() : collect();
        $plats = $lastMenu ? $lastMenu->plats : collect();
        return view('restaurant', compact('lastMenu', 'categories', 'restaurant', 'plats'));
    }

    public function destroy($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->delete();

        return redirect()->route('superadmin.restaurants.index')->with('success', 'Restaurant supprimé avec succès.');
    }
}
