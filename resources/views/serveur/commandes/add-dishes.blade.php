<!-- resources/views/serveur/commandes/add-dishes.blade.php -->

@extends('layouts.app_serveur')

@section('content')
<div class="container">
    <h2>Ajouter des plats pour la Table {{ $table->numero_table }}</h2>

    <form action="{{ route('serveur.commandes.store') }}" method="POST">
        @csrf
        <input type="hidden" name="table_id" value="{{ $table->id }}">

        <div class="row">
            @foreach($plats as $plat)
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">{{ $plat->nom }}</h5>
                        <p class="card-text">{{ $plat->description }}</p>
                        <p class="card-text">Prix : {{ $plat->prix }} CFA</p>
                        <input type="checkbox" name="plats[]" value="{{ $plat->id }}"> Ajouter à la commande
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer la commande</button>
    </form>
</div>
@endsection
