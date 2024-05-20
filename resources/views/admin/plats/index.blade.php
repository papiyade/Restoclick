@extends('layouts.app_admin')



@section('content')
    <div class="container">

        <div class="row">
            @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header flex-wrap border-0 d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="card-title" style="font-size: 28px;">Liste des Plats</h4>
                        </div>

                        <div>
                            <a href="{{ route('admin.plats.create') }}"><button type="button" class="btn btn-success "><span
                                        class="btn-icon-start text-info"><i class="fa fa-plus color-info"></i>
                                    </span>Ajouter</button></a>
                        </div>

                    </div>
                    <form style="justify-content: end; margin-left: 70%; width: 30%;"
                        action="{{ route('admin.plats.trier') }}" method="GET">
                        <div class="input-group">
                            <select class="default-select form-control wide bleft" name="tri" id="tri">
                                <option value="nom">Nom</option>
                                <option value="prix">Prix</option>
                                <option value="disponibilite">Disponibilité</option>
                            </select>
                            <button class="btn btn-primary" type="submit">Trier</button>
                        </div>
                    </form>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Description</th>
                                    <th>Prix</th>
                                    <th>Disponibilité</th>
                                    <th>Image</th>
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
                                            <td>{{ $plat->price }} Fcfa</td>
                                            <td>
                                                @if ($plat->availability === 'available')
                                                    <span class="badge badge-rounded badge-success">Disponible</span>
                                                @else
                                                    <span class="badge badge-rounded badge-danger">Non disponible</span>
                                                @endif
                                            </td>

                                            <td>
                                                @if ($plat->image_url)
                                                    <img src="{{ asset('storage/' . $plat->image_url) }}"
                                                        alt="Image du plat" style="max-width: 100px;">
                                                @else
                                                    Aucune image
                                                @endif
                                            </td>

                                            <td>{{ $plat->category->name }}</td>
                                            <td>
                                                <a href="{{ route('admin.plats.edit', $plat) }}"
                                                    class="btn btn-sm btn-primary">Modifier</a>

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
