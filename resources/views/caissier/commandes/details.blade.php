<div class="card mt-3" style="width: 100%">
    <div class="card-header">
        Facture <strong>{{ $commande->created_at->format('d/m/Y H:i') }}</strong>
        <span class="float-end">
            <strong>Status:</strong> {{$commande->statut}}
        </span>
    </div>

    <div class="card-body">
        <div class="row mb-5">
            <!-- Informations du restaurant -->
            <div class="mt-4 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                <h6>De:</h6>
                <div><strong>{{$commande->restaurant->name}}</strong></div>
                <div>Adresse: {{$commande->restaurant->address ?? 'N/A'}}</div>
                <div>Email: {{$commande->restaurant->email}}</div>
                <div>Téléphone: {{$commande->restaurant->phone_number}}</div>


            </div>

            <!-- Informations du client -->
            <div class="mt-4 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                <h6 class="text-center">A:</h6>
                <div class="text-center">Nom : <strong class="text-center">{{$commande->client_name ?? 'Client Inconnu'}}</strong></div>
                <div class="text-center">Telephone : {{$commande->telephone_client ?? 'Téléphone Non Spécifié'}}</div>
            </div>

            <!-- Numéro de table et QR Code (si applicable) -->
            <div class="mt-4 col-xl-6 col-lg-6 col-md-12 col-sm-12 d-flex justify-content-lg-end justify-content-md-center justify-content-xs-start">
                <div class="row align-items-center">
                    @if ($commande->restaurant->logo)
                    <div class="mt-3">
                        <img src="{{ Storage::url($commande->restaurant->logo) }}" alt="Logo du Restaurant" class="img-fluid" width="150">
                    </div>
                @endif
                    <div class="col-sm-9">
                        <span>Numéro de Table: <strong class="d-block">
                            @if ($commande->table)
                                {{$commande->table->id}}
                            @else
                                Commande à Emporter
                            @endif
                        </strong></span>
                    </div>

                    <div class="col-sm-3 mt-3">
                        @if($commande->table && $commande->table->qr_code)
                            <img src="{{ asset($commande->table->qr_code) }}" alt="QR Code" width="80">
                        @else
                            No QR Code
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Détails des plats commandés -->
        <div class="table-responsive">
            <table class="table table-border">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Plats</th>
                        <th>Quantité</th>
                        <th class="right">Prix Unitaire</th>
                        <th class="right">Prix Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($commande->details as $index => $detail)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>                                             <img src="{{ asset('storage/' . $detail->plat->image_url) }}" alt="Image du plat" class="rounded" style="max-width: 60px;">
                                {{ $detail->plat->name }}</td>
                            <td>{{ $detail->quantite }}</td>
                            <td>{{ $detail->plat->price }} Fcfa</td>
                            <td>{{ $detail->quantite * $detail->plat->price }} Fcfa</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Résumé du total -->
        <div class="row">
            <div class="col-lg-4 col-sm-5"></div>
            <div class="col-lg-4 col-sm-5 ms-auto">
                <table class="table table-clear">
                    <tbody>
                        <tr>
                            <td><strong>Total</strong></td>
                            <td><strong>{{$totalPrice}} Fcfa</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Bouton Encaisser -->
        <div class="row">
            <div class="col-lg-12 text-end">
                @if($commande->statut == 'en_cours')
                    <button type="button" class="btn btn-success" id="encaisser-btn-{{ $commande->id }}" onclick="encaisserCommande({{ $commande->id }})">
                        Encaisser
                    </button>
                @else
                    <span class="badge bg-success" id="status-badge-{{ $commande->id }}">Encaissée</span>
                @endif
            </div>
        </div>

        <!-- Signature du restaurant -->
        <div class="row">
            <div class="col-lg-12 text-end">
                @if ($commande->restaurant->signature)
                    <div class="mt-3">
                        <img src="{{ Storage::url($commande->restaurant->signature) }}" alt="Signature du Cachet" class="img-fluid" width="150">
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
