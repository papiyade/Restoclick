<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; // Importez le modèle User

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'phone_number', 'email','admin_id','opening_time','closing_time'];

    /**
     * Get the user associated with the restaurant.
     */
    public function user()
    {
        return $this->belongsTo(User::class); // Définissez la relation
    }

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
    public function admins()
{
    return $this->hasOne(User::class, 'restaurant_id');
}

    public function plats(){
        return $this->hasMany(Plat::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }


}
