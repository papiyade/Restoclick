<div class="card mt-3" style="width: 100%">
    <div class="card-header"> Facture <strong>{{ $commande->created_at->format('d/m/Y H:i') }}</strong> <span class="float-end">
            <strong>Status:</strong> {{$commande->statut}} </span> </div>
    <div class="card-body">
        <div class="row mb-5">
            <div class="mt-4 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                <h6>De:</h6>
                <div> <strong> {{$commande->restaurant->name}} </strong> </div>
                <div>Adresse</div>
                <div> {{$commande->address}} </div>
                <div>Email: {{$commande->restaurant->email}} </div>
                <div>Telephone: {{$commande->restaurant->phone_number}} </div>
                @if ($commande->restaurant->logo)
                    <div class="mt-3">
                        <img src="{{ Storage::url($commande->restaurant->logo) }}" alt="Logo du Restaurant" class="img-fluid" width="150">
                    </div>
                @endif
            </div>
            <div class="mt-4 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                <h6>A:</h6>
                <div> <strong> {{$commande->client_name}} </strong> </div>
                <div>{{$commande->telephone_client}}</div>
            </div>
            <div class="mt-4 col-xl-6 col-lg-6 col-md-12 col-sm-12 d-flex justify-content-lg-end justify-content-md-center justify-content-xs-start">
                <div class="row align-items-center">
                    <div class="col-sm-9">
                        <div class="brand-logo mb-2 inovice-logo">
                            <!-- Logo ajouté ici -->
                        </div>
                        <span>Numéro de Table: <strong class="d-block">
                            @if ($commande->table)
                            {{$commande->table->id}}
                            @else
                            NA
                            @endif
                        </strong>
                    </div>
                    <div class="col-sm-3 mt-3">
                        @if($commande->table->qr_code)
                        <img src="{{ asset($commande->table->qr_code) }}" alt="QR Code" width="80" >


                        @else
                        {{-- <img src="{{asset('assets/images/qr.png')}}" alt="" class="img-fluid width110"> --}}
                        No QR Code


                    @endif

                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-border">
                <thead>
                    <tr>
                        <th class="center">#</th>
                        <th>Plats</th>
                        <th>Quantité</th>
                        <th class="right">Prix Unitaire</th>
                        <th class="center">Prix Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($commande->details as $detail)
                    <tr>
                        <td class="left"></td>
                        <td class="center">{{ $detail->plat->name }}</td>
                        <td class="left strong">{{ $detail->quantite }}</td>
                        <td class="left">{{ $detail->plat->price }} F</td>
                        <td class="right">{{ $detail->quantite * $detail->plat->price }} F</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-lg-4 col-sm-5"> </div>
            <div class="col-lg-4 col-sm-5 ms-auto">
                <table class="table table-clear">
                    <tbody>
                        <tr>
                            <td class="left"><strong>Total</strong></td>
                            <td class="right"><strong>{{$totalPrice }} Fcfa</strong><br>
                                {{-- <strong>0.15050000 BTC</strong></td> --}}
                        </tr>
                    </tbody>
                </table>
            </div>
            @if($commande->statut == 'en_cours')
            <button type="button" class="btn btn-success" id="encaisser-btn-{{ $commande->id }}" onclick="encaisserCommande({{ $commande->id }})">Encaisser</button>
            @endif
        </div>
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
