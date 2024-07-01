@extends('layouts.app_admin')

@section('content')
    <h1>Créer une nouvelle réservation</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.reservation.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="client_name">Nom du client</label>
            <input type="text" class="form-control" id="client_name" name="client_name" value="{{ old('client_name') }}" required>
        </div>
        <div class="form-group">
            <label for="client_email">Email du Client</label>
            <input type="email" class="form-control" id="client_email" name="client_email" value="{{ old('client_email')}}" required>
        </div>
        <div class="form-group">
            <label for="client_phone_number">Numéro de téléphone</label>
            <input type="text" class="form-control" id="client_phone_number" name="client_phone_number" value="{{ old('client_phone_number') }}" required>
        </div>
        <div class="form-group">
            <label for="date_time">Date et heure</label>
            <input type="datetime-local" class="form-control" id="date_time" name="date_time" value="{{ old('date_time') }}" required>
        </div>
        <div class="form-group">
            <label for="num_people">Nombre de personnes</label>
            <input type="number" class="form-control" id="num_people" name="num_people" value="{{ old('num_people') }}" required>
        </div>
        <input type="hidden" name="restaurant_id" value="{{ $restaurant_id }}">
        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
@endsection
