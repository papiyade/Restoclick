@extends('layouts.app_superadmin')

@section('title', 'Page d\'accueil')

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
        <strong>Success!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
        </button>
    </div>
    @endif

                            <!-- Column starts -->
                            <div class="col-xl-12 mr-52">
                                <div class="card dz-card" id="bootstrap-table1" style="width: 100%;">
                                    <div class="card-header flex-wrap border-0 d-flex justify-content-between align-items-center">
                                        <div>
                                            <h4 class="card-title" style="font-size: 28px;">Liste des Utilisateurs</h4>
                                        </div>
                                        <div>
                                            <a href="{{route('superadmin.users.create')}}"><button type="button" class="btn btn-success "><span
                                                class="btn-icon-start text-info"><i class="fa fa-plus color-info"></i>
                                            </span>Add</button></a>
                                        </div>
                                    </div>

                                    <!--tab-content-->
                                    <div class="tab-content" id="myTabContent" >
                                        <div class="tab-pane fade show active" id="Preview" role="tabpanel" aria-labelledby="home-tab">
                                            <div class="card-body pt-0">
                                                <div class="table-responsive">
                                                    <table class="table table-responsive-md">
                                                        <thead>
                                                            <tr>
                                                                <th style="width:80px;"><strong>#</strong></th>
                                                                <th><strong>NOM</strong></th>
                                                                <th><strong>EMAIL</strong></th>
                                                                <th><strong>RESTAURANT</strong></th> <!-- Ajout de cette colonne -->
                                                                <th><strong>ROLE</strong></th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($users as $user)
                                                            <tr>
                                                                <td><strong>{{ $user->id }}</strong></td>
                                                                <td>{{ $user->name }}</td>
                                                                <td>{{ $user->email }}</td>
                                                                <td>{{ optional($user->restaurant)->name }}</td> <!-- Affichage du nom du restaurant associé à l'utilisateur -->
                                                                <td>{{ $user->role }}</td>
                                                                <td>
                                                                    <div class="dropdown">
                                                                        <button type="button" class="btn btn-success light sharp" data-bs-toggle="dropdown">
                                                                            <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                                                                        </button>
                                                                        <div class="dropdown-menu">
                                                                            <a class="dropdown-item" href="{{ route('superadmin.users.edit', ['id' => $user->id]) }}">Modifier</a>
                                                                            <form method="POST" action="{{ route('superadmin.users.destroy', $user->id) }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit" class="btn btn-danger">Supprimer</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
@endsection

@section('scripts')
    <!-- Scripts spécifiques à la page d'accueil -->
@endsection
