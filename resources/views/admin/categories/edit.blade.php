@extends('layouts.app_admin')

@section('title', 'Modifier une Catégorie')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Modifier une Catégorie</div>

                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('admin.categories.update', ['category' => $category->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Nom</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Entrez le nom de la catégorie" value="{{ old('name', $category->name) }}">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" placeholder="Entrez la description de la catégorie">{{ old('description', $category->description) }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Enregistrer les modifications</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
