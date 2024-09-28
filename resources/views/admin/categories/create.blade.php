@extends('layouts.app_admin')

@section('title', 'Créer une Catégorie')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Créer une Catégorie</div>

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

                        <form action="{{ route('admin.categories.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nom</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Entrez le nom de la catégorie" value="{{ old('name') }}" required>
                            </div>
                            <div class="form-group mt-3">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" placeholder="Entrez la description de la catégorie" rows="4">{{ old('description') }}</textarea>
                            </div>
                            <div class="mt-4 text-right">
                                <button type="submit" class="btn btn-primary">Créer</button>
                                <a href="{{ route('admin.categories.index') }}" class="btn btn-danger ml-2">Annuler</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
