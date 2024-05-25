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
                            <button class="btn " type="submit"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14.5715 13.5941L20.4266 7.72014C20.7929 7.35183 21 6.84877 21 6.32376V4.60099C21 3.52002 20.1423 3 19.0844 3H4.91556C3.85765 3 3 3.52002 3 4.60099V6.3547C3 6.85177 3.18462 7.33087 3.51772 7.69419L8.89711 13.5632C8.9987 13.674 9.14034 13.7368 9.28979 13.7378L14.1915 13.7518C14.3332 13.7528 14.4699 13.6969 14.5715 13.5941Z" fill="var(--primary)"/>
                                <path opacity="0.4" d="M9.05627 13.6857V20.2903C9.05627 20.5309 9.1774 20.7575 9.3757 20.8872C9.48901 20.9621 9.6199 21 9.7508 21C9.84946 21 9.94812 20.979 10.0399 20.9371L14.0059 19.0886C14.254 18.9738 14.4132 18.7213 14.4132 18.4428V13.6857H9.05627Z" fill="var(--primary)"/>
                                </svg></button>
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
