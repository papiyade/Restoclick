@extends('layouts.app_superadmin')

@section('title', 'Créer un restaurant')


@section('content')


                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Créer un restaurant</h4>
                        </div>
                        <div class="card-body" style="width: 70%;">
                            <form method="POST" action="{{ route('superadmin.restaurants.store') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nom du restaurant</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Adresse</label>
                                    <input type="text" class="form-control" id="address" name="address" required>
                                </div>
                                <div class="mb-3">
                                    <label for="phone_number" class="form-label">Numéro de téléphone</label>
                                    <input type="text" class="form-control" id="phone_number" name="phone_number" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="admin_id" class="form-label">Administrateur</label>
                                    <select name="admin_id" class="form-control">
                                        <option value="">Sélectionnez un administrateur</option>
                                        @foreach($admins as $admin)
                                            <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Créer</button>
                            </form>
                        </div>
                    </div>


@endsection
