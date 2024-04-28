@extends('layouts.app_admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Liste des plats</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Description</th>
                                    <th>Prix</th>
                                    <th>Disponibilité</th>
                                    <th>Catégorie</th>

                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($plats)
                                    @foreach ($plats as $plat)
                                        <tr>
                                            <td>{{ $plat->name }}</td>
                                            <td>{{ $plat->description }}</td>
                                            <td>{{ $plat->price }}</td>
                                            <td> @if ($plat->availability === 'available')
                                                <span class="badge badge-rounded badge-success">Disponible</span>
                                            @else
                                                <span class="badge badge-rounded badge-danger">Non disponible</span>
                                            @endif
                                            </td>
                                            <td>{{ $plat->category->name }}</td>

                                            <td>
                                                <a href="{{ route('admin.plats.edit', $plat) }}" class="btn btn-sm btn-primary">Modifier</a>
                                                <form action="{{ route('admin.plats.destroy', $plat) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce plat ?')">Supprimer</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6">Aucun plat trouvé.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
