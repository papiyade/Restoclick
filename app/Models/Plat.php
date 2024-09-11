<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plat extends Model
{
    use HasFactory;
    protected $fillable = ['category_id', 'name', 'description', 'price', 'image_url', 'availability','preparation_time'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menus_plats'); // Spécifiez le nom de la table pivot
    }
}
