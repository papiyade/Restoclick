@extends('layouts.app_superadmin')

@section('title', 'Modifier Restaurant')

@section('content')
    <!-- Contenu de la page d'édition -->
    <div class="col-xl-12" style="width: 90%;">
        <div class="card dz-card" id="bootstrap-table1">
            <div class="card-header flex-wrap border-0 d-flex justify-content-between align-items-center">
                <h4 class="card-title" style="font-size: 28px;">Modifier Restaurant</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('superadmin.restaurants.update', ['id' => $restaurant->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $restaurant->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Adresse</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ $restaurant->address }}">
                    </div>
                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Numéro de téléphone</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $restaurant->phone_number }}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $restaurant->email }}">
                    </div>
                    <div class="mb-3">
                        <label for="opening_time" class="form-label">Heure d'ouverture</label>
                        <input type="time" class="form-control" id="opening_time" name="opening_time" value="{{ $restaurant->opening_time }}">
                    </div>
                    <div class="mb-3">
                        <label for="closing_time" class="form-label">Heure de fermeture</label>
                        <input type="time" class="form-control" id="closing_time" name="closing_time" value="{{ $restaurant->closing_time }}">
                    </div>

                    <button type="submit" class="btn btn-primary">Modifier</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Scripts spécifiques à la page d'édition -->
@endsection
