<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Restaurant;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminAssignedToRestaurant extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $restaurant;

    public function __construct(User $user, Restaurant $restaurant)
    {
        $this->user = $user;
        $this->restaurant = $restaurant;
    }

    public function build()
    {
        return $this->markdown('emails.admin-assigned-to-restaurant')
                    ->subject('Vous êtes désormais administrateur du restaurant ' . $this->restaurant->name);
    }
}
