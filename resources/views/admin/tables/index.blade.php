@extends('layouts.app_admin')

@section('content')
    <h2>Liste des Tables</h2>
    <!-- Div parent pour aligner le filtre de statut et le bouton "Ajouter" -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <!-- Filtre de statut -->
        <div style="width: 20%;">
            <label for="status-filter" class="form-label" style="color: rgb(6, 51, 158);">Filtrer par statut :</label>
            {{-- <select id="status-filter" class="form-select" aria-label="Filtrer par statut">
                <option value="all">Tous</option>
                <option value="disponible">Disponible</option>
                <option value="occupee">Occupée</option>
            </select> --}}
            <select id="status-filter" class="default-select h-select ms-1" aria-label="Filtrer par statut">
                <option value="all">Tous</option>
                <option value="disponible">Disponible</option>
                <option value="occupee">Occupée</option>
            </select>
        </div>

        <a style="margin-right: 10%" href="{{ route('admin.tables.create') }}"><button type="button" class="btn btn-success"><span class="btn-icon-start text-info"><i class="fa fa-plus color-info"></i></span>Ajouter</button></a>

    </div>

    @if($tables->count() > 0)
        <!-- Conteneur de la table -->
        <div id="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Numéro</th>
                        <th>QR Code</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    <!-- Contenu généré par JavaScript -->
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div id="pagination-container" class="d-flex justify-content-center mt-3">
            <!-- Boutons de pagination générés par JavaScript -->
        </div>
    @else
        <p>Aucune table disponible.</p>
    @endif
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Données des tables (simule les données du serveur)
        const tables = @json($tables);

        // Paramètres de pagination
        const rowsPerPage = 4;
        let currentPage = 1;
        let filteredTables = tables; // Variable pour stocker les tables filtrées

        // Conteneurs HTML
        const tableBody = document.getElementById('table-body');
        const paginationContainer = document.getElementById('pagination-container');
        const statusFilter = document.getElementById('status-filter');

        function displayTables() {
            // Effacer le contenu précédent
            tableBody.innerHTML = '';

            // Calcul des indices pour les tables à afficher
            const startIndex = (currentPage - 1) * rowsPerPage;
            const endIndex = startIndex + rowsPerPage;
            const tablesToDisplay = filteredTables.slice(startIndex, endIndex);

            // Génération des lignes de la table
            tablesToDisplay.forEach(table => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${table.numero_table}</td>
                    <td>
                        ${table.qr_code ? `<img src="{{ asset('${table.qr_code}') }}" alt="QR Code" width="100">` : ''}
                    </td>
                    <td>
                        <span class="badge badge-${table.statut === 'disponible' ? 'success' : 'warning'}">
                            ${table.statut.charAt(0).toUpperCase() + table.statut.slice(1)}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.tables.edit', '') }}/${table.id}" class="btn btn-info">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                            </svg>
                        </a>
                        <form action="{{ route('admin.tables.destroy', '') }}/${table.id}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette table ?')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                                </svg>
                            </button>
                        </form>
                    </td>
                `;
                tableBody.appendChild(tr);
            });
        }

        function setupPagination() {
            paginationContainer.innerHTML = '';

            const pageCount = Math.ceil(filteredTables.length / rowsPerPage);
            for (let i = 1; i <= pageCount; i++) {
                const btn = document.createElement('button');
                btn.className = 'btn btn-info mx-1';
                btn.textContent = i;
                btn.addEventListener('click', function() {
                    currentPage = i;
                    displayTables();
                    highlightCurrentPage();
                });
                paginationContainer.appendChild(btn);
            }
        }

        function highlightCurrentPage() {
            const buttons = paginationContainer.querySelectorAll('button');
            buttons.forEach(btn => btn.classList.remove('active'));
            buttons[currentPage - 1].classList.add('active');
        }

        // Fonction de filtrage des tables
        function filterTables() {
            const selectedStatus = statusFilter.value;
            if (selectedStatus === 'all') {
                filteredTables = tables;
            } else {
                filteredTables = tables.filter(table => table.statut === selectedStatus);
            }
            currentPage = 1; // Reset to first page on filter change
            displayTables();
            setupPagination();
            highlightCurrentPage();
        }

        // Écouter le changement de filtre de statut
        statusFilter.addEventListener('change', filterTables);

        // Initialisation de l'affichage
        displayTables();
        setupPagination();
        highlightCurrentPage();
    });
</script>
@endsection
