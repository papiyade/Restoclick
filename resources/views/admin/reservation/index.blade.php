<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page des Réservations</title>
    <link href="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
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
            background-color: rgba(255, 255, 255, 0.472);
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
                    <a class="nav-link {{ $status == 'Confirmée' ? 'active' : '' }}" id="status-tab"
                        href="{{ route('admin.reservation.index', ['status' => 'Confirmée']) }}">Confirmée</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ $status == 'En Attente' ? 'active' : '' }}" id="inactive-tab"
                        href="{{ route('admin.reservation.index', ['status' => 'En Attente']) }}">En Attente</a>
                </li>
            </ul>
            <div>
                <a href="{{ route('admin.reservation.create') }}" class="btn btn-primary me-1">Créer une nouvelle
                    réservation</a>
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
                    <div class="tab-pane fade show active" id="active-tab-pane" role="tabpanel" aria-labelledby="active-tab"
                        tabindex="0">
                        <div class="card mt-2">
                            <div class="card-body p-0">
                                <div class="table-responsive active-projects style-1 ItemsCheckboxSec shorting">
                                    <div class="p-3" style="width: 30%;">
                                        <input type="text" id="search" class="form-control"
                                            placeholder="Rechercher un client...">
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
                                                <th>Email</th>
                                                <th>Téléphone</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="customers">
                                            @forelse ($reservations as $reservation)
                                                <tr class="btn-reveal-trigger" id="reservation-{{ $reservation->id }}">
                                                    <td class="py-2">
                                                        <div class="form-check custom-checkbox mx-2">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="customCheckBox{{ $reservation->id }}">
                                                            <label class="form-check-label"
                                                                for="customCheckBox{{ $reservation->id }}"></label>
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
                                                    <td style="text-align:center" class="py-2">
                                                        {{ \Carbon\Carbon::parse($reservation->date_time)->format('d/m/Y') }}
                                                    </td>
                                                    <td style="text-align:center" class="py-2">
                                                        {{ \Carbon\Carbon::parse($reservation->date_time)->format('H:i') }}
                                                    </td>
                                                    <td style="text-align:center" class="py-2">
                                                        {{ $reservation->num_people }}</td>
                                                    <td style="text-align: center" class="py-2">
                                                        {{ $reservation->client_email }}</td>
                                                    <td style="text-align:center" class="py-2">
                                                        {{ $reservation->client_phone_number }}</td>

                                                        <td class="py-2 text-end">
                                                            @if ($reservation->status === 'En Attente')
                                                                <button class="btn btn-primary btn-sm confirm-reservation"
                                                                    data-reservation-id="{{ $reservation->id }}">Confirmer</button>
                                                                <button class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                                                                    data-bs-target="#emailModal"
                                                                    onclick="setReservationDetails({{ $reservation->id }}, '{{ $reservation->client_name }}', '{{ $reservation->client_email }}', '{{ \Carbon\Carbon::parse($reservation->date_time)->format('d/m/Y H:i') }}', '{{ $reservation->num_people }}')">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                        height="16" fill="currentColor"
                                                                        class="bi bi-envelope-arrow-up-fill"
                                                                        viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zm.192 8.159 6.57-4.027L8 9.586l1.239-.757.367.225A4.49 4.49 0 0 0 8 12.5c0 .526.09 1.03.256 1.5H2a2 2 0 0 1-1.808-1.144M16 4.697v4.974A4.5 4.5 0 0 0 12.5 8a4.5 4.5 0 0 0-1.965.45l-.338-.207z" />
                                                                        <path
                                                                            d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.354-5.854a.5.5 0 1 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-1-1a.5.5 0 0 1 .708-.708L11.5 12.293l1.646-1.647z" />
                                                                    </svg>
                                                                </button>
                                                            @elseif ($reservation->status === 'Confirmée')
                                                                <span class="badge badge-success badge-confirmed">Confirmée</span>
                                                            @endif

                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8" class="text-center">Aucune réservation trouvée</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-between mt-3">
                                        <div>
                                            @if ($reservations instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                                <p>Affichage de {{ $reservations->firstItem() }} à
                                                    {{ $reservations->lastItem() }} sur
                                                    {{ $reservations->total() }} réservations</p>
                                            @endif
                                        </div>
                                        <div>
                                            {{ $reservations->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- SweetAlert2 Success Modal -->
                        <div class="modal fade" id="sweetSuccessModal" tabindex="-1"
                            aria-labelledby="sweetSuccessModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="swal2-icon swal2-success swal2-icon-show" style="display: flex;">
                                            <div class="swal2-success-circular-line-left" style="background-color: #fff;">
                                            </div>
                                            <span class="swal2-success-line-tip"></span>
                                            <span class="swal2-success-line-long"></span>
                                            <div class="swal2-success-ring"></div>
                                            <div class="swal2-success-fix" style="background-color: #fff;"></div>
                                            <div class="swal2-success-circular-line-right"
                                                style="background-color: #fff;"></div>
                                        </div>
                                        <div id="sweetAlertMessage" class="text-center"></div>
                                        <button type="button" class="btn btn-primary mt-3"
                                            data-bs-dismiss="modal">Fermer</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Email Modal -->
                        <div class="modal fade" id="emailModal" tabindex="-1" aria-labelledby="emailModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="emailModalLabel">Envoyer un email</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="emailForm">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                            <input type="hidden" id="reservationId">
                                            <div class="mb-3">
                                                <label for="clientName" class="form-label">Nom du client</label>
                                                <input type="text" class="form-control" id="clientName" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="clientEmail" class="form-label">Email du client</label>
                                                <input type="email" class="form-control" id="clientEmail" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="reservationDateTime" class="form-label">Date et heure de
                                                    réservation</label>
                                                <input type="text" class="form-control" id="reservationDateTime"
                                                    readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="numPeople" class="form-label">Nombre de personnes</label>
                                                <input type="text" class="form-control" id="numPeople" readonly>
                                            </div>
                                             <div class="mb-3">
                                                <label for="emailMessage" class="form-label">Message</label>
                                                <textarea class="form-control" id="emailMessage" rows="3"></textarea>
                                            </div>
                                            <button type="button" class="btn btn-primary"
                                                id="sendEmailButton">Envoyer</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endsection

                    @section('scripts')
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        <script>
                            function setReservationDetails(reservationId, clientName, clientEmail, reservationDateTime, numPeople) {
                                document.getElementById('reservationId').value = reservationId;
                                document.getElementById('clientName').value = clientName;
                                document.getElementById('clientEmail').value = clientEmail;
                                document.getElementById('reservationDateTime').value = reservationDateTime;
                                document.getElementById('numPeople').value = numPeople;
                            }
                            document.addEventListener('DOMContentLoaded', function () {
    // Recherche en temps réel
    document.getElementById('search').addEventListener('input', function () {
        var filter = this.value.toUpperCase();
        var rows = document.querySelectorAll('#customers tr');
        rows.forEach(row => {
            var td = row.getElementsByTagName('td')[1];
            if (td) {
                var txtValue = td.textContent || td.innerText;
                row.style.display = txtValue.toUpperCase().indexOf(filter) > -1 ? "" : "none";
            }
        });
    });

    // Confirmer la réservation
    document.querySelectorAll('.confirm-reservation').forEach(button => {
        button.addEventListener('click', function () {
            var reservationId = this.getAttribute('data-reservation-id');
            fetch(`/admin/reservation/confirm/${reservationId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    var row = document.getElementById(`reservation-${reservationId}`);
                    row.querySelector('.confirm-reservation').remove();
                    Swal.fire({
                        icon: 'success',
                        title: 'Réservation confirmée!',
                        text: data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        text: data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'Une erreur est survenue lors de la confirmation.',
                    showConfirmButton: false,
                    timer: 1500
                });
            });
        });
    });

    // Envoyer un email
    document.getElementById('sendEmailButton').addEventListener('click', function () {
        var reservationId = document.getElementById('reservationId').value;
        var emailMessage = document.getElementById('emailMessage').value;

        fetch('{{ route('admin.reservation.send-email') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                reservation_id: reservationId,
                message: emailMessage
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Email envoyé!',
                    text: data.message,
                    showConfirmButton: false,
                    timer: 1500
                });
                document.getElementById('emailMessage').value = '';
                var emailModal = new bootstrap.Modal(document.getElementById('emailModal'));
                emailModal.hide();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: data.message,
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: 'Une erreur est survenue lors de l\'envoi de l\'email.',
                showConfirmButton: false,
                timer: 1500
            });
        });
    });
});

                        </script>
                    @endsection
</body>

</html>
