@extends('layouts.app_admin')

@section('content')
<div class="container">
    <h1>Détails du serveur</h1>
    <p><strong>Nom:</strong> {{ $serveur->name }}</p>
    <p><strong>Email:</strong> {{ $serveur->email }}</p>
    <a href="{{ route('serveurs.index') }}" class="btn btn-secondary">Retour</a>
</div>
@endsection
