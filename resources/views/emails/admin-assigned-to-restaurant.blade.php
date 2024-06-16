@component('mail::message')
# Vous êtes désormais administrateur du restaurant {{ $restaurant->name }}

Bonjour {{ $user->name }},

Félicitations ! Vous avez été désigné comme administrateur du restaurant **{{ $restaurant->name }}**.

Voici les détails du restaurant :
- **Nom**: {{ $restaurant->name }}
- **Adresse**: {{ $restaurant->address }}
- **Téléphone**: {{ $restaurant->phone_number }}
- **Email**: {{ $restaurant->email }}

Merci,<br>
{{ config('app.name') }}
@endcomponent
