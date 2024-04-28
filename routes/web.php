<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PlatController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Auth;

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
        if (Auth::user()->hasRole('superadmin')) {
            return redirect()->route('superadmin.users.index');
        }
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

Route::get('superadmin/restaurants/{id}/edit', [RestaurantController::class , 'edit'])->name('superadmin.restaurants.edit');
Route::put('superadmin/restaurants/{id}', [RestaurantController::class, 'update'])->name('superadmin.restaurants.update');
Route::delete('superadmin/restaurants/{id}', [RestaurantController::class,'destroy'])->name('superadmin.restaurants.destroy');

Route::middleware(['web', 'auth', 'redirectIfAuthenticated'])->group(function () {
});
    //  routes categories

Route::get('admin/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
Route::get('admin/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
Route::post('admin/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
Route::get('admin/categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
Route::put('admin/categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
Route::delete('admin/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
    // Routes plats
// Route::get('admin/plats', [PlatController::class, 'index'])->name('admin.plats.index');
// Route::get('admin/plats/create', [PlatController::class, 'create'])->name('admin.plats.create');
// Route::post('admin/plats', [PlatController::class, 'store'])->name('admin.plats.store');
// Route::get('admin/plats/{plat}/edit', [PlatController::class, 'edit'])->name('admin.plats.edit');
// Route::put('admin/plats/{plat}', [PlatController::class, 'update'])->name('admin.plats.update');
// Route::delete('admin/plats/{plat}', [PlatController::class, 'destroy'])->name('admin.plats.destroy');
Route::get('admin/plats', [PlatController::class, 'index'])->name('admin.plats.index');
Route::get('admin/plats/create', [PlatController::class, 'create'])->name('admin.plats.create');
Route::post('admin/plats', [PlatController::class, 'store'])->name('admin.plats.store');
    Route::get('admin/plats/{plat}/edit', [PlatController::class,'edit'])->name('admin.plats.edit');
    Route::put('admin/plats/{plat}', [PlatController::class,'update'])->name('admin.plats.update');
    Route::delete('admin/plats/{plat}', [PlatController::class,'destroy'])->name('admin.plats.destroy');


    Route::get('admin/menus', [MenuController::class, 'index'])->name('admin.menus.index');
    Route::get('admin/menus/create', [MenuController::class, 'create'])->name('admin.menus.create');
    Route::post('admin/menus', [MenuController::class, 'store'])->name('admin.menus.store');
    Route::get('admin/menus/{menu}/edit', [MenuController::class, 'edit'])->name('admin.menus.edit');
    Route::put('admin/menus/{menu}', [MenuController::class, 'update'])->name('admin.menus.update');
    Route::delete('admin/menus/{menu}', [MenuController::class, 'destroy'])->name('admin.menus.destroy');
