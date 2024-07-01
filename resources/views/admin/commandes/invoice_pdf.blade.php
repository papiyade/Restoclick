<!DOCTYPE html>
<html>
<head>
    <title>Facture de commande N° {{ $commande->id }}</title>
    <style>
        /* Styles CSS optionnels pour la mise en page du PDF */
        body {
            font-family: DejaVu Sans, Arial, sans-serif;
        }
        /* Ajoutez vos styles CSS personnalisés ici */
    </style>
</head>
<body>
    <h2>Facture de commande N° {{ $commande->id }}</h2>
  <div class="row" style="display: flex; align-items:center">
    <div class="mt-4 col-xl-3 col-lg-3 col-md-6 col-sm-12">
        <h6>De:</h6>
        <div> <strong> {{$commande->restaurant->name}} </strong> </div>
        <div>Adresse</div>
        <div> {{$commande->address}} </div>
        <div>Email: {{$commande->restaurant->email}} </div>
        <div>Telephone: {{$commande->restaurant->phone_number}} </div>
    </div>
    <div class="mt-4 col-xl-3 col-lg-3 col-md-6 col-sm-12">
        <h6>A:</h6>
        <div> <strong> {{$commande->client_name}} </strong> </div>
        <div>Attn: Daniel Marek</div>
        <div>43-190 Mikolow, Poland</div>
        <div>Email: marek@daniel.com</div>
        <div>{{$commande->telephone_client}}</div>
    </div>
</div>

    <table border="1" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th>Plat</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Sous-total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($commande->details as $detail)
                <tr>
                    <td>{{ $detail->plat->name }}</td>
                    <td>{{ $detail->quantite }}</td>
                    <td>{{ $detail->plat->price }}</td>
                    <td>{{ $detail->quantite * $detail->plat->price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p><strong style="margin-left: 42%">Total:</strong> {{ $totalPrice }}</p>
</body>
</html>
