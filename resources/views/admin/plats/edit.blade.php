

@extends('layouts.app_admin')

@section('title', 'Modifier Plat')

@section('content')
<div class="container">
    <h2>Modifier le plat "{{ $plat->name }}"</h2>
    <form action="{{ route('admin.plats.update', $plat) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label class="font-italic" for="name">Nom du Plat</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ $plat->name }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" id="description">{{ $plat->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="price">Prix</label>
            <input type="number" class="form-control" name="price" id="price" value="{{ $plat->price }}" required>
        </div>
        <div class="form-group">
            <label for="availability">Disponibilité</label>
            <select class="form-control" name="availability" id="availability" required>
                <option value="available" {{ $plat->availability == 'available' ? 'selected' : '' }}>Disponible</option>
                <option value="unavailable" {{ $plat->availability == 'unavailable' ? 'selected' : '' }}>Non disponible</option>
            </select>
        </div>
        <div class="form-group">
            <label for="preparation_time">Temps de Préparation (en minutes)</label>
            <input type="number" class="form-control" id="preparation_time" name="preparation_time" min="1" placeholder="Exemple : 5">
        </div>
        <div class="form-group">
            <label for="category_id">Catégorie</label>
            <select class="form-control" name="category_id" id="category_id" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $plat->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control-file" name="image" id="image">
        </div>
        <button type="submit" class="btn btn-primary mt-3">Mettre à jour le plat</button>
    </form>
</div>
@endsection
