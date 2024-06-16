<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page des Réservations</title>
    <link href="{{asset('assets/vendor/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/style.css" rel="stylesheet')}}">
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

    #sweetSuccessModal .modal-dialog {
        max-width: 400px;
    }


    </style>
</head>
<body>
    @extends('layouts.app_admin')
    @section('title', 'Page des Réservations')

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
            <a href="{{ route('admin.reservation.create') }}" class="btn btn-primary me-1">Créer une nouvelle réservation</a>
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
                                            <th>Nom</th>
                                            <th>Date de Réservation</th>
                                            <th>Heure de Réservation</th>
                                            <th>Nombre de Personnes</th>
                                            <th>Téléphone</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="customers">
                                        @forelse ($reservations as $reservation)
                                            <tr class="btn-reveal-trigger">
                                                <td class="py-2">
                                                    <div class="form-check custom-checkbox mx-2">
                                                        <input type="checkbox" class="form-check-input" id="customCheckBox{{ $reservation->id }}">
                                                        <label class="form-check-label" for="customCheckBox{{ $reservation->id }}"></label>
                                                    </div>
                                                </td>
                                                <td class="py-2">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-circle">
                                                            {{ strtoupper(substr($reservation->client_name, 0, 1)) }}
                                                        </div>
                                                        <span class="ms-2">{{ $reservation->client_name }}</span>
                                                    </div>
                                                </td>
                                                <td class="py-2">{{ \Carbon\Carbon::parse($reservation->date_time)->format('d/m/Y') }}</td>
                                                <td class="py-2">{{ \Carbon\Carbon::parse($reservation->date_time)->format('H:i') }}</td>
                                                <td class="py-2">{{ $reservation->num_people }}</td>
                                                <td class="py-2">{{ $reservation->client_phone_number }}</td>
                                                <td class="py-2 text-end">
                                                    @if ($reservation->status === 'En Attente')
                                                        <button class="btn btn-primary btn-sm" onclick="confirmReservation({{ $reservation->id }})">Confirmer</button>
                                                    @else
                                                        <span class="badge bg-success">Confirmée</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center py-3">Aucune réservation trouvée.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>



                            <div class="d-flex justify-content-center mt-3">
                                <nav>
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
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    @endsection

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#search').on('keyup', function() {
                var query = $(this).val();
                $.ajax({
                    url: "{{ route('admin.reservation.index') }}",
                    type: "GET",
                    data: {'search': query},
                    success: function(data) {
                        $('#customers').html(data.html);
                    }
                });
            });
        });


    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="{{asset('assets/vendor/global/global.min.js')}}"></script>
    <script src="{{asset('assets/vendor/sweetalert2/dist/sweetalert2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins-init/sweetalert.init.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('assets/js/custom.js')}}"></script>
    <script src="{{asset('assets/js/deznav-init.js')}}"></script>


    {{-- <script src="{{asset('assets/js/demo.js')}}"></script>
    <script src="{{asset('assets/js/styleSwitcher.js')}}"></script> --}}

 <script>
        function confirmReservation(reservationId) {
            $.ajax({
                url: "{{ route('admin.reservation.confirm', ['id' => ':id']) }}".replace(':id', reservationId),
                type: "POST",
                data: {
                    '_token': '{{ csrf_token() }}',
                },
                success: function(data) {
                    if (data.success) {
                        // Mettre à jour l'affichage pour déplacer la réservation confirmée
                        var confirmedReservation = $('#customCheckBox' + reservationId).closest('tr');
                        confirmedReservation.find('.btn-primary').remove(); // Retirer le bouton "Confirmer"
                        confirmedReservation.find('.text-end').html('<span class="badge bg-success">Confirmée</span>'); // Afficher le badge "Confirmée"

                        // Afficher Sweet Success
                        Swal.fire({
    title: 'Réservation Confirmée!',
    text: 'La réservation a été confirmée avec succès.',
    icon: 'success',
    confirmButtonText: 'OK'
});

                    }
                }
            });
        }
    </script>



</body>
</html>
``
