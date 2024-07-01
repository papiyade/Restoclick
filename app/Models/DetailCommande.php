<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailCommande extends Model
{
    protected $fillable = [
        'commande_id',
        'plat_id',
        'quantite', // Assurez-vous que cette colonne correspond à celle dans votre table
    ];

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    public function plat()
    {
        return $this->belongsTo(Plat::class);
    }
}
