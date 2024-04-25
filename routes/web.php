<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\RestaurantController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('admin/index',[AdminController::class,'index'])->name('admin.index');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

});
Route::get('superadmin/index',[SuperAdminController::class,'index'])->name(('superadmin.index'));
Route::get('superadmin/restaurants/create', [RestaurantController::class, 'create'])->name('superadmin.restaurants.create');
Route::post('admin/restaurants', [RestaurantController::class, 'store'])->name('admin.restaurants.store');

Route::get('superadmin/restaurants/index', [RestaurantController::class, 'index'])->name('superadmin.restaurants.index');
Route::get('superadmin/users/index', [AdminController::class, 'index'])->name('superadmin.users.index');

// Route pour afficher le formulaire de création d'utilisateur
Route::get('/superadmin/users/create', [AdminController::class, 'create'])->name('superadmin.users.create');
// Route pour enregistrer un nouvel utilisateur
Route::post('/superadmin/users', [AdminController::class, 'store'])->name('superadmin.users.store');

// Route pour la création d'un restaurant
Route::get('/superadmin/restaurants/create', [RestaurantController::class, 'create'])->name('superadmin.restaurants.create');
// Route pour la création d'un restaurant
Route::post('/superadmin/restaurants', [RestaurantController::class, 'store'])->name('superadmin.restaurants.store');
Route::get('superadmin/users/{id}/edit', [AdminController::class, 'edit'])->name('superadmin.users.edit');
Route::put('superadmin/users/{id}', [AdminController::class, 'update'])->name('superadmin.users.update');
Route::delete('superadmin/users/{id}', [AdminController::class,'destroy'])->name('superadmin.users.destroy');


