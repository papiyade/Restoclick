@extends('layouts.app_admin')
@section('content')
<div class="container">
    <h1>Liste des cuisiniers</h1>
    <a href="{{ route('cuisinier.create') }}" class="btn btn-primary mb-3">Ajouter un cuisinier</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cuisiniers as $cisinier)
                <tr>
                    <td>{{ $cuisinier->name }}</td>
                    <td>{{ $cuisinier->email }}</td>
                    <td>
                        <a href="{{ route('cuisinier.show', $serveur->id) }}" class="btn btn-info">Voir</a>
                        <a href="{{ route('cuisinier.edit', $serveur->id) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('cuisinier.destroy', $serveur->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
