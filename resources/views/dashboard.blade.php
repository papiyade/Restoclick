{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


</x-app-layout> --}}
@extends('layouts.app_admin')

@section('title', 'Page d\'accueil')

@section('content')
    <!-- Contenu de la page d'accueil -->


        <div class="card">
            <div class="card-header border-0">
                <h3 class="h-title">Revenue</h3>
                      <a href="{{route('superadmin.restaurants.create')}}"><button class=" btn btn-primary">Add resto</button></a>
            </div>
        </div>

@endsection

@section('scripts')
    <!-- Scripts spécifiques à la page d'accueil -->
@endsection
