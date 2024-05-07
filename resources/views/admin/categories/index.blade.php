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
                                <div class="text-center">
                                    <a href="{{ route('admin.categories.create') }}" class="btn btn-success">Ajouter une catégorie</a>
                                </div>
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

            </div>
        </div>
    </div>
@endsection

@section('scripts')



@endsection
