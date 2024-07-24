<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page des Commandes</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .avatar-circle {
            display: inline-block;
            width: 40px;
            height: 40px;
            line-height: 40px;
            border-radius: 50%;
            background-color: #007bff;
            color: white;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    @extends('layouts.app_admin')
    @section('title', 'Page des Reservations')
    @section('content')
    <div class="d-flex justify-content-between mb-4 flex-wrap">
        <ul class="revnue-tab nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="status-tab" data-bs-toggle="tab" data-bs-target="#active-tab-pane"
                    type="button" role="tab" aria-controls="active-tab-pane"
                    aria-selected="true">Confirmée</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="inactive-tab" data-bs-toggle="tab" data-bs-target="#inactive-tab-pane"
                    type="button" role="tab" aria-controls="inactive-tab-pane" aria-selected="false">En
                    Attente</button>
            </li>
        </ul>
        <div>
            <a href="javascript:void(0)" class="btn btn-primary me-1">+ Nouveau Client</a>
            <select class="default-select h-select ms-1" aria-label="Default select example">
                <option selected>Semaine</option>
                <option value="1">Mois</option>
                <option value="2">Quotidien</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="table table-sm mb-0 table-striped student-tbl" id="myTabContent">
                <div class="tab-pane fade show active" id="active-tab-pane" role="tabpanel" aria-labelledby="active-tab"
                    tabindex="0">
                    <div class="card mt-2">
                        <div class="card-body p-0">
                        
                            <div class="table-responsive active-projects style-1 ItemsCheckboxSec shorting">
                                <div class="p-3" style="width: 40%;">
                                    <input type="text" id="search-commandes" class="form-control" placeholder="Rechercher un client...">
                                </div>

                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>ID</th>
                                            <th>Nom du Client</th>
                                            <th>Statut Commande</th>
                                            <th>Date de Commande</th>
                                            <th>Téléphone</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($commandes as $commande)
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="check{{ $commande->id }}">
                                                    <label class="form-check-label" for="check{{ $commande->id }}"></label>
                                                </div>
                                            </td>
                                            <td>{{ $commande->id }}</td>
                                            <td>{{ $commande->client_name }}</td>
                                            <td>
                                                @php
                                                $badgeClass = $commande->statut === 'En Cours' ? 'bg-warning' : ($commande->statut === 'En cours' ? 'bg-primary' : ($commande->statut === 'Terminée' ? 'bg-success' :  ($commande->statut === 'Annulé' ? 'bg-danger' : 'btn-danger')));
                                            @endphp

                                            <span class="badge {{ $badgeClass }}">
                                                {{ $commande->statut }}
                                            </span>

                                            </td>
                                            <td>{{ $commande->created_at->format('d/m/Y H:i') }}</td>
                                            <td>{{ $commande->telephone_client }}</td>
                                            <td class="py-2">
                                                <div class="d-flex align-items-center">

                                                    <a class="dropdown-item view-order-details"
                                                        href="javascript:void(0);"
                                                        data-order-id="{{ $commande->id }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                            height="20" fill="currentColor"
                                                            style="color: rgb(9, 100, 185);" class="bi bi-eye-fill"
                                                            viewBox="0 0 16 16">
                                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                                            <path
                                                                d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                                        </svg>
                                                    </a>
                                                    <a class="dropdown-item text-danger ms-2"
                                                        href="javascript:void(0);">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                            height="20" fill="currentColor"
                                                            class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                            <path
                                                                d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </td>
                                            <div class="modal fade" id="orderDetailsModal" tabindex="-1"
                                                aria-labelledby="orderDetailsModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <!-- Utilisation de la classe modal-lg pour un modal plus large -->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="orderDetailsModalLabel">
                                                                Détails de la Commande</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div id="order-details-content">
                                                                <!-- Les détails de la commande seront chargés ici -->
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <!-- Autres boutons du modal -->
                                                            <a href="{{ route('admin.commandes.downloadPDF', $commande->id) }}"
                                                                class="btn btn-primary"
                                                                target="_blank">Télécharger PDF</a>
                                                            <button type="button" class="btn btn-danger"
                                                                data-bs-dismiss="modal">Fermer</button>
                                                                <td>
                                                                    <div class="dropdown">
                                                                        <button class="btn btn-info dropdown-toggle" type="button"
                                                                            id="dropdownMenuButton{{ $commande->id }}" data-bs-toggle="dropdown"
                                                                            aria-expanded="false">
                                                                            Changer Statut
                                                                        </button>
                                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $commande->id }}">
                                                                            <li><a class="dropdown-item" href="#"
                                                                                    onclick="changeStatus({{ $commande->id }}, 'en_cours')">En
                                                                                    cours</a></li>
                                                                            <li><a class="dropdown-item" href="#"
                                                                                    onclick="changeStatus({{ $commande->id }}, 'terminee')">Terminée</a></li>
                                                                            <li><a class="dropdown-item" href="#"
                                                                                    onclick="changeStatus({{ $commande->id }}, 'annulee')">Annulée</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Aucune commande trouvée.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{ $commandes->links() }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="inactive-tab-pane" role="tabpanel" aria-labelledby="inactive-tab"
                    tabindex="0">
                    <!-- Contenu pour les réservations en attente -->
                </div>
            </div>
        </div>
    </div>
    @endsection
    <script src="{{ asset('assets/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins-init/sweetalert.init.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/js/deznav-init.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#searche').on('keyup', function() {
                var query = $(this).val();
                $.ajax({
                    url: "{{ route('admin.commandes.index') }}",
                    type: "GET",
                    data: {
                        'search': query
                    },
                    success: function(data) {
                        $('#customers').html(data.html);
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.view-order-details').on('click', function() {
                var orderId = $(this).data('order-id');
                $.ajax({
                    url: "{{ route('admin.commandes.show', ['commande' => ':id']) }}".replace(
                        ':id', orderId),
                    type: "GET",
                    success: function(data) {
                        $('#order-details-content').html(data.html);
                        $('#orderDetailsModal').modal('show');
                    }
                });
            });
        });
    </script>
    {{-- <script>
        function changeStatus(id, status) {
            if (confirm(`Êtes-vous sûr de vouloir changer le statut de la commande ${id} à ${status}?`)) {
                fetch(`/change-status/${id}/${status}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            id: id,
                            status: status
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Erreur lors de la mise à jour du statut');
                        }
                        return response.json();
                    })
                    .then(data => {
                        alert('Statut de la commande mis à jour avec succès');
                        location.reload();
                    })
                    .catch(error => {
                        console.error('Erreur:', error);
                        alert('Erreur lors de la mise à jour du statut');
                    });
            }
        }
    </script> --}}
    <script>
        function changeStatus(id, status) {
            if (confirm(`Êtes-vous sûr de vouloir changer le statut de la commande ${id} à ${status}?`)) {
                fetch(`/change-status/${id}/${status}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ id: id, status: status })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Erreur lors de la mise à jour du statut');
                    }
                    return response.json();
                })
                .then(data => {
                    alert('Statut de la commande mis à jour avec succès');
                    location.reload();
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    alert('Erreur lors de la mise à jour du statut');
                });
            }
        }
    </script>
       <script>
        $(document).ready(function() {
            $('.view-order-details').on('click', function() {
                var orderId = $(this).data('order-id');
                $.ajax({
                    url: "{{ route('admin.commandes.show', ['commande' => ':id']) }}".replace(
                        ':id', orderId),
                    type: "GET",
                    success: function(data) {
                        $('#order-details-content').html(data.html);
                        $('#orderDetailsModal').modal('show');
                    }
                });
            });
        });
    </script>
</body>

</html>
