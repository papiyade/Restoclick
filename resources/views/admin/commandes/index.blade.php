<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page des Commandes</title>
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
                <button class="nav-link active" id="status-tab" data-bs-toggle="tab" data-bs-target="#active-tab-pane" type="button" role="tab" aria-controls="active-tab-pane" aria-selected="true">Confirmée</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="inactive-tab" data-bs-toggle="tab" data-bs-target="#inactive-tab-pane" type="button" role="tab" aria-controls="inactive-tab-pane" aria-selected="false">En Attente</button>
            </li>
        </ul>
        <div>
            <a href="javascript:void(0)" class="btn btn-primary me-1">+ New Customer</a>
            <select class="default-select h-select ms-1" aria-label="Default select example">
                <option selected>Week</option>
                <option value="1">Month</option>
                <option value="2">Daily</option>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="table table-sm mb-0 table-striped student-tbl" id="myTabContent">
                <div class="tab-pane fade show active" id="active-tab-pane" role="tabpanel" aria-labelledby="active-tab" tabindex="0">
                    <div class="card mt-2">
                        <div class="card-body p-0">
                            <div class="table-responsive active-projects style-1 ItemsCheckboxSec shorting">
                                <div class="p-3" style="width: 40%;">
                                    <input type="text" id="search" class="form-control" placeholder="Rechercher un client...">
                                </div>
                                <table class="table table-sm mb-0 table-striped student-tbl">
                                    <thead>
                                        <tr>
                                            <th class="pe-3">
                                                <div class="form-check custom-checkbox mx-2">
                                                    <input type="checkbox" class="form-check-input" id="checkAll">
                                                    <label class="form-check-label" for="checkAll"></label>
                                                </div>
                                            </th>
                                            <th>ID </th>
                                            <th> Nom du Client</th>
                                            <th> Statut Commande</th>
                                            <th>Date de Commande</th>
                                            <th>Téléphone</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="customers">
                                        @forelse ($commandes as $commande)
                                            <tr class="btn-reveal-trigger">
                                                <td class="py-2">
                                                    <div class="form-check custom-checkbox mx-2">
                                                        <input type="checkbox" class="form-check-input" id="customCheckBox{{ $commande->id }}">
                                                        <label class="form-check-label" for="customCheckBox{{ $commande->id }}"></label>
                                                    </div>
                                                </td>
                                                <td class="py-2"> {{$commande->id}} </td>
                                                <td class="py-2">
                                                    <div class="d-flex align-items-center">
                                                        {{-- <div class="avatar-circle">
                                                            {{ strtoupper(substr($commande->client_name, 0, 1)) }}
                                                        </div> --}}
                                                        <div class="avatar avatar-sm">
                                                            <img class="rounded-circle img-fluid" src="{{asset('assets/images/avatar/1.png')}}" alt="" width="30">
                                                        </div>
                                                        <span class="ms-2">{{ $commande->client_name }}</span>
                                                    </div>
                                                </td>
                                                <td class="py-2">{{ $commande->statut}}</td>
                                                <td class="py-2"> Le {{$commande->created_at->format('d/m/Y H:i')}} </td>
                                                <td class="py-2"> {{$commande->telephone_client  }}</td>

                                                <td class="py-2">
                                                    <div class="d-flex align-items-center">

                                                            <a class="dropdown-item view-order-details"  href="javascript:void(0);" data-order-id="{{ $commande->id }}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" style="color: rgb(9, 100, 185);" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                                                </svg>
                                                            </a>




                                                        <a class="dropdown-item text-danger ms-2" href="javascript:void(0);">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </td>

                                                <div class="modal fade" id="orderDetailsModal" tabindex="-1" aria-labelledby="orderDetailsModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="orderDetailsModalLabel">Détails de la Commande</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div id="order-details-content">
                                                                    <!-- Les détails de la commande seront chargés ici -->
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">Aucune Commande pour le moment</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{ $commandes->links() }}
                            </div>
                            <div class="d-flex justify-content-center mt-3">
                                {{-- <nav>
                                    <ul class="pagination">
                                        <li class="page-item page-indicator">
                                            <a class="page-link" href="{{ $reservations->previousPageUrl() }}" aria-label="Previous">
                                                <i class="la la-angle-left"></i>
                                            </a>
                                        </li>
                                        @for ($i = 1; $i <= $reservations->lastPage(); $i++)
                                            <li class="page-item {{ $i == $reservations->currentPage() ? 'active' : '' }}">
                                                <a class="page-link" href="{{ $reservations->url($i) }}">{{ $i }}</a>
                                            </li>
                                        @endfor
                                        <li class="page-item page-indicator">
                                            <a class="page-link" href="{{ $reservations->nextPageUrl() }}" aria-label="Next">
                                                <i class="la la-angle-right"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </nav> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="inactive-tab-pane" role="tabpanel" aria-labelledby="inactive-tab" tabindex="0">
                    <!-- Contenu pour les réservations en attente -->
                </div>
            </div>
        </div>
    </div>

    @endsection

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#searche').on('keyup', function() {
                var query = $(this).val();
                $.ajax({
                    url: "{{ route('admin.commandes.index') }}",
                    type: "GET",
                    data: {'search': query},
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
                url: "{{ route('admin.commandes.show', ['commande' => ':id']) }}".replace(':id', orderId),
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
