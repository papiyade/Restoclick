@extends('layouts.app_admin')

@section('content')
<div class="container">
    <h1>Liste des serveurs</h1>
    <a href="{{ route('serveurs.create') }}" class="btn btn-primary mb-3">Ajouter un serveur</a>

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
            @foreach ($serveurs as $serveur)
                <tr>
                    <td>{{ $serveur->name }}</td>
                    <td>{{ $serveur->email }}</td>
                    <td>
                        <a href="{{ route('serveurs.show', $serveur->id) }}" class="btn btn-info">Voir</a>
                        <a href="{{ route('serveurs.edit', $serveur->id) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('serveurs.destroy', $serveur->id) }}" method="POST" style="display:inline;">
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
