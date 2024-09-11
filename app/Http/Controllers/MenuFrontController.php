<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MenuFrontController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */



    public function showeMenuParId($id){
        $restaurant = Restaurant::findOrFail($id);
        $menus = $restaurant->menus;
        $lastMenu = $menus->last();

        $categories = $lastMenu ? Category::whereIn('id', $lastMenu->plats->pluck('category_id'))->get() : collect();
        $plats = $lastMenu ? $lastMenu->plats : collect();
        return view('restaurant', compact('lastMenu', 'categories', 'restaurant', 'plats'));
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
