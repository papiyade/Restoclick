<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>


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
                                            <td class="py-2">{{ $reservation->client_name }}</td>
                                            <td class="py-2">{{ \Carbon\Carbon::parse($reservation->date_time)->format('d/m/Y') }}</td>
                                            <td class="py-2">{{ \Carbon\Carbon::parse($reservation->date_time)->format('H:i') }}</td>
                                            <td class="py-2">{{ $reservation->num_people }}</td>
                                            <td class="py-2">{{ $reservation->client_phone_number }}</td>
                                            <td class="py-2 text-end">
                                                <div class="dropdown">
                                                    <button class="btn btn-primary tp-btn-light sharp" type="button" data-bs-toggle="dropdown">
                                                        <span class="fs--1">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24"></rect>
                                                                    <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                                                                    <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                                                    <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                                                                </g>
                                                            </svg>
                                                        </span>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end border py-0">
                                                        <div class="py-2">
                                                            <a class="dropdown-item" href="javascript:void(0);">Edit</a>
                                                            <a class="dropdown-item text-danger" href="javascript:void(0);">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Aucune réservation pour le moment</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
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
