<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ConfigController extends Controller
{
    //
    public function index()
    {
        $restaurant = Auth::user()->restaurant;
        return view('config.index', compact('restaurant'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'signature' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $restaurant = Auth::user()->restaurant;

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $restaurant->logo = $logoPath;
        }

        if ($request->hasFile('signature')) {
            $signaturePath = $request->file('signature')->store('signatures', 'public');
            $restaurant->signature = $signaturePath;
        }

        $restaurant->save();

        return redirect()->route('config.index')->with('success', 'Configuration mise à jour avec succès.');
    }

}
