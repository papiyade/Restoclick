{{-- @component('mail::message')

<img src="" alt="">
# Bienvenue dans notre application

Bonjour {{ $user->name }},

Un compte a été créé pour vous sur notre plateforme.

Voici vos informations de connexion :
- **Email**: {{ $user->email }}
- **Mot de passe**: {{ $password }}

Vous pouvez vous connecter en utilisant ces informations dès maintenant.

Merci,<br>
{{ config('app.name') }}
@endcomponent --}}


{{-- @component('mail::message')
    <!-- Ajoutez l'image directement ici -->
    <img src="https://th.bing.com/th/id/R.aa26854d66f4cbc544527066ab957885?rik=hqAYVV2iqDsYIA&riu=http%3a%2f%2fwww.inmediobai.com%2fwp-content%2fuploads%2f2017%2f05%2fbanniere-email.png&ehk=tvF5Iw4BYlpm0GG9WZtxu9uyU9fN9XGC1oVo826yaj0%3d&risl=&pid=ImgRaw&r=0" alt="Logo" style="max-width: 200px;">

    # Bienvenue dans notre application

    Bonjour {{ $user->name }},

    Un compte a été créé pour vous sur notre plateforme.

    Voici vos informations de connexion :
    - **Email**: {{ $user->email }}
    - **Mot de passe**: {{ $password }}

    Vous pouvez vous connecter en utilisant ces informations dès maintenant.

    Merci,<br>
    {{-- {{ config('app.name') }} --}}
    {{-- RestoLink
@endcomponent --}}

<!DOCTYPE html>
<html>
<head>
    <title>Confirmation de votre réservation</title>
</head>
<body>
    <img src="https://th.bing.com/th/id/R.aa26854d66f4cbc544527066ab957885?rik=hqAYVV2iqDsYIA&riu=http%3a%2f%2fwww.inmediobai.com%2fwp-content%2fuploads%2f2017%2f05%2fbanniere-email.png&ehk=tvF5Iw4BYlpm0GG9WZtxu9uyU9fN9XGC1oVo826yaj0%3d&risl=&pid=ImgRaw&r=0" alt="Logo" style="max-width: 200px;">

    <h1>Bonjour {{ $user->name}},</h1>
    <p> Un compte a été créé pour vous sur notre plateforme.</p>
    <p>Voici vos informations de connexion : </p>
    <p>Email: {{ $user->email }}</p>
    <p >Mot de passe: {{ $password }}</p>


       <p>Vous pouvez vous connecter en utilisant ces informations dès maintenant.</p>
    <p>Merci et à bientôt !</p>
    <p>RestoLink</p>
</body>
</html>
