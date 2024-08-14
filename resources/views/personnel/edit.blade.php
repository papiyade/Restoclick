@extends('layouts.app_admin')

@section('content')
<div class="container">
    <h2>Modifier un utilisateur</h2>

    <form action="{{ route('personnel.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nom :</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="form-group">
            <label for="password">Mot de passe (Laissez vide si vous ne souhaitez pas le changer) :</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="form-group">
            <label for="role">Rôle :</label>
            <select name="role" class="form-control" required>
                @foreach($roles as $role)
                    <option value="{{ $role }}" {{ $role == $user->role ? 'selected' : '' }}>{{ ucfirst($role) }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
