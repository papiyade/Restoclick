@extends('layouts.app_admin')

@section('content')
    <div class="container">
        <h2>Configuration du Restaurant</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('config.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="logo" class="form-label">Logo du Restaurant</label>
                <input type="file" style="width: 50%" class="form-control" id="logo" name="logo">
                @if ($restaurant->logo)
                    <img src="{{ Storage::url($restaurant->logo) }}" alt="Logo" class="img-thumbnail mt-2" width="150">
                @endif
            </div>

            <div class="mb-3">
                <label for="signature" class="form-label">Signature du Cachet</label>
                <input type="file" style="width: 50%" class="form-control" id="signature" name="signature">
                @if ($restaurant->signature)
                    <img src="{{ Storage::url($restaurant->signature) }}" alt="Signature" class="img-thumbnail mt-2" width="150">
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
@endsection
