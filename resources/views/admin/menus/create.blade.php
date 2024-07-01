@extends('layouts.app_admin')

@section('title', 'Page d\'accueil')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

@section('content')
<div class="container">
    <h2>Créer le menu du jour</h2>
    <form action="{{ route('admin.menus.store') }}" method="POST">
        @csrf
        <div class="form-group" style="width: 50%;">
            <label class="font-italic" for="name">Nom du Menu</label>
            <input type="text" class="form-control" name="name" id="name" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" id="description" style="width: 50%;"></textarea>
        </div>
        <div class="form-group">
            <label for="price">Prix</label>
            <input type="number" name="prix" id="prix" class="form-control" step="0.01"
                required>
        </div>
        <div class="row mt-3">
            @php $colWidth = 6 / count($categories); @endphp <!-- Calcul de la largeur des colonnes -->
            @foreach($categories as $category)
            <div class="col-md-{{ $colWidth }}">
                <div class="form-group">
                    <label class="badge badge-rounded badge-info fs-15" for="category{{ $category->id }}">{{ $category->name }}</label>
                    <select class="form-control" name="plats[]" id="category{{ $category->id }}" multiple data-none-selected-text="Aucun plat Sélectionné">
                        @foreach($category->plats as $plat)
                            @if($plat->availability == 'available')
                                <option class="fs-15" value="{{ $plat->id }}">{{ $plat->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            @endforeach

        </div>
        <button type="submit" class="btn btn-primary mt-3">Créer Menu</button>
    </form>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {

        $('select').selectpicker();
    });
</script>
@endsection
