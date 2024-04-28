@extends('layouts.app_admin')

@section('title', 'Page d\'accueil')

@section('content')
<!-- Formulaire de création de menu -->
<form action="{{ route('admin.menus.store') }}" method="POST">
    @csrf
    <div class="col-sm-6">
        <label for="name">Nom du Menu</label>
        <input type="text" class="form-control" name="name" id="name" required>
    </div>
    <div class="col-sm-6">
        <label for="description">Description</label>
        <textarea class="form-control" name="description" id="description"></textarea>
    </div>
    <div>
        <label>Plats</label>
        <!-- Afficher les plats avec des cases à cocher -->
        @foreach($plats as $plat)
            <div class="mb-3">
                <div class="form-check form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="plats[]" value="{{ $plat->id }}">
                    <label>{{ $plat->name }}</label>
                </div>
            </div>

        @endforeach

    </div>
    <button type="submit" class="btn btn-primary">Créer Menu</button>
</form>



@endsection

@section('scripts')
    <!-- Scripts spécifiques à la page d'accueil -->
@endsection

