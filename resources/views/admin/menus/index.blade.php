@extends('layouts.app_admin')

@section('title', 'Page d\'accueil')

@section('content')
<!-- Afficher la liste des menus -->
@foreach($menus as $menu)
    <div>
        <h3>{{ $menu->name }}</h3>
        <p>{{ $menu->description }}</p>
        <!-- Afficher les plats du menu -->
        <ul>
            @foreach($menu->plats as $plat)
                <li>{{ $plat->name }}</li>
            @endforeach
        </ul>
        <!-- Boutons d'action pour modifier et supprimer -->
        <a href="{{ route('admin.menus.edit', $menu) }}">Modifier</a>
        <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Supprimer</button>
        </form>
    </div>
@endforeach


@endsection

@section('scripts')
    <!-- Scripts spécifiques à la page d'accueil -->
@endsection
