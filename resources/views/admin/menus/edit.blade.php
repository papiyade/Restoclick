@extends('layouts.app_admin')

@section('title', 'Modifier le menu')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>


@section('content')
<div class="container">
    <h2>Modifier le menu "{{ $menu->name }}"</h2>
    <form action="{{ route('admin.menus.update', $menu) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group" style="width: 50%;">
            <label class="font-italic" for="name">Nom du Menu</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ $menu->name }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" id="description" style="width: 50%;">{{ $menu->description }}</textarea>
        </div>
        <div class="row mt-3">
            @php $colWidth = 8 / count($categories); @endphp 
            @foreach($categories as $category)
            <div class="col-md-{{ $colWidth }}">
                <div class="form-group">
                    <label class="badge badge-rounded badge-info fs-15" for="category{{ $category->id }}">{{ $category->name }}</label>
                    <select class="form-control" name="plats[]" id="category{{ $category->id }}" multiple data-none-selected-text="Aucun plat sélectionné">
                        @foreach($category->plats as $plat)
                            @if($plat->availability == 'available')
                                <option class="fs-15" value="{{ $plat->id }}" {{ $menu->plats->contains($plat->id) ? 'selected' : '' }}>{{ $plat->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary mt-3">Mettre à jour le menu</button>
    </form>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Initialiser les listes déroulantes Bootstrap selectpicker
        $('select').selectpicker();
    });
</script>
@endsection
