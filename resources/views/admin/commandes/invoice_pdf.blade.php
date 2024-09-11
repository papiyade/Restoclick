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

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .signature {
            text-align: right;
            margin-top: 40px;
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

        th,
        td {
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
            <div class="logo">
                @if ($commande->restaurant->logo)
                    <img src="{{ public_path('storage/' . $commande->restaurant->logo) }}" alt="Logo"
                        class="img-thumbnail mt-2" width="100">
                @endif


            </div>
            <div><strong>{{ $commande->restaurant->name }}</strong></div>
            <div>Adresse: {{ $commande->restaurant->address }}</div>
            <div>Email: {{ $commande->restaurant->email }}</div>
            <div>Téléphone: {{ $commande->restaurant->phone_number }}</div>
        </div>
        <div class="column">
            <h6>Détails de la commande:</h6>
            <div><strong>Mode de commande:</strong> {{ $commande->mode_commande }}</div>
            <div><strong>Nom du client:</strong> {{ $commande->client_name }}</div>
            <div><strong>Téléphone du client:</strong> {{ $commande->telephone_client }}</div>
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
            @foreach ($commande->details as $detail)
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
    <div class="signature">
        @if ($commande->restaurant->signature)
        <img src="{{ public_path('storage/' . $commande->restaurant->signature) }}" alt="Signature du Cachet" width="100">


            {{-- <img src="{{ Storage::url($commande->restaurant->signature) }}" alt="Signature du Cachet" width="150"> --}}
        @endif
    </div>
</body>

</html>
