@component('mail::message')
# Bienvenue dans notre application

Bonjour {{ $user->name }},

Un compte a été créé pour vous sur notre plateforme.

Voici vos informations de connexion :
- **Email**: {{ $user->email }}
- **Mot de passe**: {{ $password }}

Vous pouvez vous connecter en utilisant ces informations dès maintenant.

Merci,<br>
{{ config('app.name') }}
@endcomponent
