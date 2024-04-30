@extends('layouts.app_superadmin')

@section('title', 'Modifier un utilisateur')

@section('content')

                        <div class="card-header">
                            <h4 class="card-title">Modifier un utilisateur</h4>
                        </div>
                        <div class="card-body" style="width: 70%;">
                            <form method="POST" action="{{ route('superadmin.users.update', $user->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nom</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Nouveau mot de passe </label>
                                    <input type="password"  class="form-control" id="password" name="password">
                                </div>
                                <div class="mb-3">
                                    <label for="confirm_password" class="form-label">Confirmer le nouveau mot de passe</label>
                                    <input type="password" class="form-control" id="confirm_password" name="password_confirmation">
                                </div>
                                <button type="submit" class="btn btn-primary">Modifier</button>
                            </form>
                        </div>
                    </div>
@endsection
