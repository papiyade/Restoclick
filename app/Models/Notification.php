<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_name', 'client_phone_number', 'date_time', 'num_people', 'message', 'link', 'is_read'
    ];
}
