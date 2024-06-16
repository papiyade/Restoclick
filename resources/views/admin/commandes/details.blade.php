<!-- resources/views/admin/commandes/details.blade.php -->
<div>
    {{-- <p>ID Commande: {{ $commande->id }}</p> --}}
    <p>Nom du Client: {{ $commande->client_name }}</p>
    <p>Statut: {{ $commande->statut }}</p>
    <p>Date de Commande: {{ $commande->created_at->format('d/m/Y H:i') }}</p>
    <p>Téléphone: {{ $commande->telephone_client }}</p>

    <!-- Affichage des plats commandés -->
    <div>
        <h4>Plats commandés</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>Nom du Plat</th>
                    <th>Quantité</th>
                    <th>Prix unitaire</th>
                    <th>Prix total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($commande->details as $detail)
                <tr>
                    <td>{{ $detail->plat->name }}</td>
                    <td>{{ $detail->quantite }}</td>
                    <td>{{ $detail->plat->price }} F</td>
                    <td>{{ $detail->quantite * $detail->plat->price }} F</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <h3 style="margin-left: 46%; font-size:18px;">Total à payer : {{ $totalPrice }} F</h3>
    </div>
</div>
