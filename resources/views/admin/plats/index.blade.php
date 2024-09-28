@extends('layouts.app_admin')

@section('content')
<div class="container">

    <div class="col-md-12">
        <div class="card">
            <div class="card-header flex-wrap border-0 d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="ml-4"> La liste des plats du restaurant</h3>
                </div>

                <div>
                    <a href="{{ route('admin.plats.create') }}">
                        <button type="button" class="btn btn-success">
                            <span class="btn-icon-start text-info">
                                <i class="fa fa-plus color-info"></i>
                            </span>
                            Ajouter
                        </button>
                    </a>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-group" style="margin-bottom: 0;">
                    <input type="text" id="searchInput" class="form-control" style="width: 100%; margin-left: 20%;" placeholder="Rechercher un plat...">
                </div>

                <form style="width: 30%;" action="{{ route('admin.plats.trier') }}" method="GET">
                    <div class="input-group">
                        <select class="default-select form-control wide bleft" name="tri" id="tri">
                            <option value="nom">Nom</option>
                            <option value="prix">Prix</option>
                            <option value="disponibilite">Disponibilité</option>
                        </select>
                        <button class="btn" type="submit">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14.5715 13.5941L20.4266 7.72014C20.7929 7.35183 21 6.84877 21 6.32376V4.60099C21 3.52002 20.1423 3 19.0844 3H4.91556C3.85765 3 3 3.52002 3 4.60099V6.3547C3 6.85177 3.18462 7.33087 3.51772 7.69419L8.89711 13.5632C8.9987 13.674 9.14034 13.7368 9.28979 13.7378L14.1915 13.7518C14.3332 13.7528 14.4699 13.6969 14.5715 13.5941Z" fill="var(--primary)"/>
                                <path opacity="0.4" d="M9.05627 13.6857V20.2903C9.05627 20.5309 9.1774 20.7575 9.3757 20.8872C9.48901 20.9621 9.6199 21 9.7508 21C9.84946 21 9.94812 20.979 10.0399 20.9371L14.0059 19.0886C14.254 18.9738 14.4132 18.7213 14.4132 18.4428V13.6857H9.05627Z" fill="var(--primary)"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

            <div class="card-body">
                <table class="table" id="platsTable">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Prix</th>
                            <th>Disponibilité</th>
                            <th>Temps de Cuisson</th>
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
                                    <td> {{$plat->preparation_time}} min </td>
                                    <td>
                                        @if ($plat->image_url)
                                            <img class="rounded" src="{{ asset('storage/' . $plat->image_url) }}" alt="Image du plat" style="max-width: 100px;">
                                        @else
                                            Aucune image
                                        @endif
                                    </td>
                                    <td>{{ $plat->category->name }}</td>
                                    <td>
                                        <a href="{{ route('admin.plats.edit', $plat) }}" class="btn btn-sm btn-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                            </svg>
                                        </a>

                                        <form action="{{ route('admin.plats.destroy', $plat) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce plat ?')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0v-8.5a.5.5 0 0 0-.5-.5"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8" class="text-center">Aucun plat trouvé.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>

               <!-- Contrôles de pagination -->
               <div id="paginationControls" class="mt-3 d-flex justify-content-center"></div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const platsTable = document.getElementById('platsTable');
        const rows = platsTable.querySelectorAll('tbody tr');

        searchInput.addEventListener('keyup', function() {
            const filter = searchInput.value.toLowerCase();

            rows.forEach(row => {
                const cells = row.getElementsByTagName('td');
                let found = false;

                for (let i = 0; i < cells.length; i++) {
                    const cell = cells[i];
                    if (cell) {
                        if (cell.textContent.toLowerCase().indexOf(filter) > -1) {
                            found = true;
                            break;
                        }
                    }
                }

                if (found) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById("searchInput");
        const platsTable = document.getElementById("platsTable").getElementsByTagName("tbody")[0];
        const paginationControls = document.getElementById("paginationControls");

        // Variables de pagination
        const platsParPage = 3; // Nombre de plats par page
        let platsTotaux = platsTable.getElementsByTagName("tr").length;
        let pageActuelle = 1;

        // Fonction de pagination
        function afficherPage(page) {
            const rows = platsTable.getElementsByTagName("tr");
            const debut = (page - 1) * platsParPage;
            const fin = page * platsParPage;

            for (let i = 0; i < rows.length; i++) {
                rows[i].style.display = (i >= debut && i < fin) ? "" : "none";
            }

            afficherControlePagination(page);
        }

        // Fonction pour afficher les contrôles de pagination
        function afficherControlePagination(page) {
            paginationControls.innerHTML = "";
            const pagesTotales = Math.ceil(platsTotaux / platsParPage);

            for (let i = 1; i <= pagesTotales; i++) {
                const bouton = document.createElement("button");
                bouton.textContent = i;
                bouton.className = "btn btn-info mx-1";
                bouton.onclick = function() {
                    pageActuelle = i;
                    afficherPage(pageActuelle);
                };

                if (i === page) {
                    bouton.classList.add("active");
                }

                paginationControls.appendChild(bouton);
            }
        }

        // Fonction de recherche
        // searchInput.addEventListener("keyup", function() {
        //     const filter = searchInput.value.toLowerCase();
        //     const rows = platsTable.getElementsByTagName("tr");

        //     platsTotaux = 0;

        //     for (let i = 0; i < rows.length; i++) {
        //         const row = rows[i];
        //         const cells = row.getElementsByTagName("td");

        //         let matchFound = false;
        //         for (let j = 0; j < cells.length; j++) {
        //             if (cells[j]) {
        //                 const cellValue = cells[j].textContent || cells[j].innerText;
        //                 if (cellValue.toLowerCase().indexOf(filter) > -1) {
        //                     matchFound = true;
        //                     break;
        //                 }
        //             }
        //         }

        //         if (matchFound) {
        //             row.style.display = "";
        //             platsTotaux++;
        //         } else {
        //             row.style.display = "none";
        //         }
        //     }

        //     afficherPage(1);
        // });

        // Afficher la première page au chargement
        afficherPage(pageActuelle);
    });
</script>
@endsection
@endsection
