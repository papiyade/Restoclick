@extends('layouts.app_admin')

@section('title', 'Liste des Catégories')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card-header flex-wrap border-0 d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="card-title" style="font-size: 28px;">Liste des Catégories</h4>
                    </div>
                    <div>
                        <a href="{{route('admin.categories.create')}}"><button type="button" class="btn btn-success "><span
                            class="btn-icon-start text-info"><i class="fa fa-plus color-info"></i>
                        </span>Ajouter</button></a>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                <div class="custom-control d-inline custom-checkbox">
                                    <input type="checkbox" class="form-check-input" id="checkAll" required="">
                                    <label class="form-check-label" for="checkAll"></label>
                                </div>
                            </th>
                            <th scope="col"><strong>ID</strong></th>
                            <th scope="col"> <strong>Nom</strong></th>
                            <th scope="col"> <strong>Description</strong></th>
                            <th scope="col"> <strong>Actions</strong></th>
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
                                    <a href="{{ route('admin.categories.edit', ['category' => $category->id]) }}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>

                                    <form id="delete-category-form-{{ $category->id }}" action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger sweet-confirm" data-id="{{ $category->id }}"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $categories->links() }} <!-- Afficher les liens de pagination générés par Laravel -->

            </div>
        </div>
    </div>

   
@endsection
