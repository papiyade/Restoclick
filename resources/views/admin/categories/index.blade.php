@extends('layouts.app_admin')

@section('title', 'Liste des Catégories')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h1 class="text-center mb-4">Liste des Catégories</h1>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <table class="table">
                    <thead>
                        <tr>
                        <th>
                            <div class="custom-control d-inline custom-checkbox">
                                <input type="checkbox" class="form-check-input" id="checkAll" required="">
                                <label class="form-check-label" for="checkAll"></label>
                            </div>
                        </th>
                            <th scope="col">ID</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Description</th>
                            <th scope="col">Actions</th>
                            <th scope="col"> <a href="">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.4" d="M19.6432 9.48844C19.6432 9.55644 19.1103 16.2972 18.8059 19.1341C18.6152 20.875 17.4929 21.931 15.8094 21.961C14.5159 21.99 13.2497 22 12.0038 22C10.6812 22 9.38766 21.99 8.13209 21.961C6.50501 21.922 5.38171 20.845 5.20082 19.1341C4.88766 16.2872 4.36442 9.55644 4.3547 9.48844C4.34497 9.28344 4.41111 9.08845 4.54532 8.93046C4.67758 8.78446 4.8682 8.69647 5.06855 8.69647H18.9391C19.1385 8.69647 19.3194 8.78446 19.4623 8.93046C19.5956 9.08845 19.6627 9.28344 19.6432 9.48844Z" fill="var(--primary)"/>
                                    <path d="M21 5.97686C21 5.56588 20.6761 5.24389 20.2871 5.24389H17.3714C16.7781 5.24389 16.2627 4.8219 16.1304 4.22692L15.967 3.49795C15.7385 2.61698 14.9498 2 14.0647 2H9.93624C9.0415 2 8.26054 2.61698 8.02323 3.54595L7.87054 4.22792C7.7373 4.8219 7.22185 5.24389 6.62957 5.24389H3.71385C3.32386 5.24389 3 5.56588 3 5.97686V6.35685C3 6.75783 3.32386 7.08982 3.71385 7.08982H20.2871C20.6761 7.08982 21 6.75783 21 6.35685V5.97686Z" fill="var(--primary)"/>
                                    </svg>
                            </a></th>

                        </tr>


                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>
                                    <div class="form-check custom-checkbox ">
                                        <input type="checkbox" class="form-check-input" id="customCheckBox2" required="">
                                        <label class="form-check-label" for="customCheckBox2"></label>
                                    </div>
                                </td>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->description }}</td>
                                <td>
                                    <a href="{{ route('admin.categories.edit', ['category' => $category->id]) }}" class="btn btn-primary">Modifier</a>
                                    {{-- <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?')">Supprimer</button>
                                    </form> --}}
                                    {{-- <form id="delete-category-form-{{ $category->id }}" action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger sweet-confirm" data-id="{{ $category->id }}">Supprimer</button>
                                    </form> --}}
                                    <form id="delete-category-form-{{ $category->id }}" action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger sweet-confirm" data-id="{{ $category->id }}">Supprimer</button>
                                    </form>

                                    <div class="modal fade" id="sweet-confirm-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="card-title" id="exampleModalLabel">Confirmation de suppression</h5>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <h4 class="">Voulez vous vraiment supprimer cette catégorie ?</h4>
                                                    <div class="card-content">
                                                        <div class="sweetalert5">
                                                            <button class="btn btn-warning btn sweet-success-cancel">Sweet Confirm Or Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-warning btn sweet-success-cancel" id="annuler" data-dismiss="modal">Annuler</button>
                                                    <button type="button" class="btn btn-danger sweet-success-cancel" id="confirm-delete">Supprimer</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <script>
                                        document.addEventListener('DOMContentLoaded', function () {
                                            // Récupérer tous les boutons avec la classe sweet-confirm
                                            const deleteButtons = document.querySelectorAll('.sweet-confirm');

                                            // Ajouter un écouteur d'événements à chaque bouton
                                            deleteButtons.forEach(button => {
                                                button.addEventListener('click', function () {
                                                    const categoryId = this.getAttribute('data-id');

                                                    // Ouvrir le modal SweetAlert
                                                    $('#sweet-confirm-modal').modal('show');

                                                    // Gérer le clic sur le bouton de confirmation dans le modal
                                                    document.getElementById('confirm-delete').addEventListener('click', function () {
                                                        // Soumettre le formulaire de suppression
                                                        document.getElementById('delete-category-form-' + categoryId).submit();
                                                    });
                                                    document.getElementById('annuler').addEventListener('click', function () {
                                                        $('#sweet-confirm-modal').modal('hide');

                                                    });

                                                });
                                            });
                                        });
                                    </script>


                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-success">Ajouter une catégorie</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')



@endsection
