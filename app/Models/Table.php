<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;
    protected $fillable = [
        'numero_table',
        'qr_code',
        'statut',
    ];

    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
