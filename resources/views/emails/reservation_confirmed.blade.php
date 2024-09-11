<!DOCTYPE html>
<html>
<head>
    <title>Confirmation de votre réservation</title>
</head>
<body>
    <img src="https://th.bing.com/th/id/R.aa26854d66f4cbc544527066ab957885?rik=hqAYVV2iqDsYIA&riu=http%3a%2f%2fwww.inmediobai.com%2fwp-content%2fuploads%2f2017%2f05%2fbanniere-email.png&ehk=tvF5Iw4BYlpm0GG9WZtxu9uyU9fN9XGC1oVo826yaj0%3d&risl=&pid=ImgRaw&r=0" alt="Logo" style="max-width: 200px;">

    <h1>Bonjour {{ $reservation->client_name }},</h1>
    <p>Nous sommes heureux de vous  confirmer votre réservation au restaurant {{$reservation->restaurant->name}} .</p>
    <p>Vous obtiendrez ci-dessous les détails de la réservation :</p>
    <ul>
        <li>Date et heure : {{ $reservation->date_time }}</li>
        <li>Nombre de personnes : {{ $reservation->num_people }}</li>
        <li>Restaurant : {{ $reservation->restaurant->name }}</li>
        <li>Adresse : {{ $reservation->restaurant->address}}</li>
    </ul>
    <p>Merci et à bientôt !</p>
</body>
</html>
