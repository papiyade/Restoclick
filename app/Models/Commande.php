<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'serveur_id',
        'table_id',
        'statut',
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function serveur()
    {
        return $this->belongsTo(User::class, 'serveur_id');
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
