<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $fillable = [
        'client_id',
        'client_name',
        'restaurant_id',
        'statut',
        'telephone_client'
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function serveur()
    {
        return $this->belongsTo(User::class, 'serveur_id');
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function details()
    {
        return $this->hasMany(DetailCommande::class);
    }

    public function paiement()
    {
        return $this->hasOne(Paiement::class);
    }
    
}
