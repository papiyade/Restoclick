@extends('layouts.app_admin')

@section('content')
    <h1>Créer une Nouvelle Table</h1>
    <form action="{{ route('admin.tables.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="numero_table">Numéro de Table</label>
            <input type="text" name="numero_table" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="qr_code">QR Code (optionnel)</label>
            <input type="text" name="qr_code" class="form-control">
        </div>
        <div class="form-group">
            <label for="statut">Statut</label>
            <select name="statut" class="form-control" required>
                <option value="disponible">Disponible</option>
                <option value="occupee">Occupée</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Créer</button>
    </form>
@endsection
