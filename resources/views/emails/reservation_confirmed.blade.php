<!DOCTYPE html>
<html>
<head>
    <title>Confirmation de votre réservation</title>
</head>
<body>
    <h1>Bonjour {{ $reservation->client_name }},</h1>
    <p>Nous sommes heureux de vous confirmer votre réservation au restaurant.</p>
    <p>Détails de la réservation :</p>
    <ul>
        <li>Date et heure : {{ $reservation->date_time }}</li>
        <li>Nombre de personnes : {{ $reservation->num_people }}</li>
        <li>Restaurant : {{ $reservation->restaurant->name }}</li>
    </ul>
    <p>Merci et à bientôt !</p>
</body>
</html>
