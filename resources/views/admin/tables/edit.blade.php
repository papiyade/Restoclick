@extends('layouts.app_admin')

@section('content')
    <h1>Modifier la Table</h1>
    <form action="{{ route('admin.tables.update', $table) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="numero_table">Numéro de Table</label>
            <input type="text" name="numero_table" class="form-control" value="{{ $table->numero_table }}" required>
        </div>
        <div class="form-group">
            <label for="qr_code">QR Code (optionnel)</label>
            <input type="text" name="qr_code" class="form-control" value="{{ $table->qr_code }}">
        </div>
        <div class="form-group">
            <label for="statut">Statut</label>
            <select name="statut" class="form-control" required>
                <option value="disponible" {{ $table->statut == 'disponible' ? 'selected' : '' }}>Disponible</option>
                <option value="occupee" {{ $table->statut == 'occupee' ? 'selected' : '' }}>Occupée</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Mettre à jour</button>
    </form>
@endsection
