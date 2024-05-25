<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_name',
        'client_phone_number',
        'date_time',
        'num_people',
        'restaurant_id',
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function table()
    {
        return $this->belongsTo(Table::class);
    }
}
