<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\User;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {

    //     $restaurants = Restaurant::all();
    //     return view('superadmin.restaurants.index', compact('restaurants'));
    // }
    public function index()
{
    $restaurants = Restaurant::with('admin')->get();
    return view('superadmin.restaurants.index', compact('restaurants'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $admins = User::where('role', 'admin')->get();
        return view('superadmin.restaurants.create', compact('admins'));


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'phone_number' => 'required|string',
            'email' => 'required|email',
            'admin_id' => 'required|exists:users,id', // Validation pour l'ID de l'administrateur
        ]);

        // Créez le restaurant avec admin_id
        $restaurant = Restaurant::create([
            'name' => $validatedData['name'],
            'address' => $validatedData['address'],
            'phone_number' => $validatedData['phone_number'],
            'email' => $validatedData['email'],
            'admin_id' => $validatedData['admin_id'], // Assurez-vous que admin_id est inclus
        ]);

        return redirect()->route('superadmin.restaurants.index')->with('success', 'Restaurant ajouté avec succès');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
