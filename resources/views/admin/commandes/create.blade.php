@extends('layouts.app_admin')

@section('content')
<div class="container">
    <h2>Créer une commande</h2>

    <form action="{{ route('admin.commandes.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="client_name">Nom du client :</label>
            <input type="text" name="client_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="telephone_client">Téléphone du client :</label>
            <input type="text" name="telephone_client" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="plats">Sélectionnez les plats :</label>
            <select name="plats[]" class="form-control" multiple required>
                @foreach($plats as $plat)
                    <option value="{{ $plat->id }}">{{ $plat->nom }} - {{ $plat->price }} FCFA</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Créer la commande</button>
    </form>
</div>
@endsection
