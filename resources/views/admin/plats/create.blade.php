@extends('layouts.app_admin')

@section('content')
    <div class="container">
        <div class="row">

                <div class="card" style="width: 70%;">
                    <div class="card-header">Créer un nouveau plat</div>

                    <div class="card-body">
                        <form action="{{ route('admin.plats.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="name">Nom du plat</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="price">Prix</label>
                                <input type="number" name="price" id="price" class="form-control" step="0.01"
                                    required>
                            </div>


                            <div class="mb-3">
                                <label for="image" class="form-label">Choisir une Image</label>
                                <input class="form-control" name="image_url" type="file" id="image">
                            </div>


                            <div class="form-group">
                                <label for="availability">Disponibilité</label>
                                <select name="availability" id="availability" class="form-control" required>
                                    <option value="available">Disponible</option>
                                    <option value="unavailable">Non disponible</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="category_id">Catégorie</label>
                                <select name="category_id" id="category_id" class="form-control" required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Créer le plat</button>
                        </form>
                    </div>
                </div>

        </div>
    </div>
@endsection
