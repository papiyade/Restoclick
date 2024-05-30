<?php

namespace App\Http\Controllers;

use App\Models\Plat;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function show($id)
    {
        $plat = Plat::findOrFail($id);
        return view('shop-detail', compact('plat'));
    }
}
