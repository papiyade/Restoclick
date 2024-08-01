<!DOCTYPE html>
<html>
<head>
    <title>Facture de commande N° {{ $commande->id }}</title>
    <style>
        /* Styles CSS pour la mise en page du PDF */
        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            margin: 20px;
            padding: 0;
        }
        h2 {
            text-align: center;
            color: #1c45cd;
            margin-bottom: 30px;
        }
        .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .column {
            flex: 0 0 45%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
            box-sizing: border-box;
        }
        h6 {
            margin-bottom: 10px;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #1c45cd;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .total {
            text-align: right;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h2>Facture de commande N° {{ $commande->id }}</h2>
    <div class="row">
        <div class="column">
            <h6>De:</h6>
            <div><strong>{{ $commande->restaurant->name }}</strong></div>
            <div>Adresse</div>
            <div>{{ $commande->restaurant->address }}</div>
            <div>Email: {{ $commande->restaurant->email }}</div>
            <div>Téléphone: {{ $commande->restaurant->phone_number }}</div>
        </div>
        <div class="column">
            <h6>A:</h6>
            <div><strong>{{ $commande->client_name }}</strong></div>
            <div>{{ $commande->telephone_client }}</div>
        </div>
    </div>
    <table>
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
                    <td>{{ $detail->plat->price }} Fcfa</td>
                    <td>{{ $detail->quantite * $detail->plat->price }} Fcfa</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p class="total">Total: {{ $totalPrice }} Fcfa</p>
</body>
</html>
