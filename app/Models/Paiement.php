<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    protected $fillable = [
        'commande_id',
        'montant',
        'date_heure',
        'mode_paiement',
        'first_name',
        'last_name',
        'username',
        'email',
        'address',
        'address2',
        'country',
        'state',
        'zip',
        'same_address',
        'save_info',
        'payment_method',
        'cc_name',
        'cc_number',
        'cc_expiration',
        'cc_cvv',
    ];

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }
}
