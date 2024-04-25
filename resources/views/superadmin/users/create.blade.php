@extends('layouts.app_superadmin')

@section('title', 'Page d\'accueil')

@section('content')

                <div class="card" style="width: 70%;">
                    <div class="card-header">
                        <h4 class="card-title">Ajouter un utilisateur</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('superadmin.users.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Confirmer le mot de passe</label>
                                <input type="password" class="form-control" id="confirm_password" name="password_confirmation" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </form>
                    </div>
                </div>


@endsection

@section('scripts')
    <!-- Scripts spécifiques à la page d'accueil -->
@endsection
