@extends('layouts.app_admin')

@section('title', 'Page d\'accueil')

@section('content')
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="row">
    @foreach ($menus as $index => $menu)
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-4" style="width: 60%">
            <div class="card shadow-sm border-0 rounded">
                <div class="card-body">
                    <h5 class="card-title text-primary">{{ $menu->name }}</h5>
                    <p class="card-text text-muted">{{ $menu->description }}</p>

                    @foreach ($categories as $category)
                        @if ($menu->plats->where('category_id', $category->id)->count() > 0)
                            <h6 class="text-secondary mt-3">{{ $category->name }}</h6>
                            <ul class="list-group list-group-flush">
                                @foreach ($menu->plats->where('category_id', $category->id) as $plat)
                                    <li class="list-group-item d-flex justify-content-between align-items-center custom-bg-color">
                                        <a href="#"
                                            onclick="afficherImageAgrandie('{{ asset('storage/' . $plat->image_url) }}')">
                                            @if ($plat->image_url)
                                                <img src="{{ asset('storage/' . $plat->image_url) }}"
                                                    alt="Image du plat" class="img-fluid" style="max-width: 60px;" class="rounded">
                                            @endif
                                        </a>
                                        <span class="text-dark fs-18">{{ $plat->name }}</span>
                                        <span class="badge badge-primary badge-rounded">{{ $plat->price }} Fcfa</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    @endforeach

                    <hr>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <a href="{{ route('admin.menus.edit', $menu) }}" class="btn btn-outline-primary">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger"
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce menu ?')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                        <a href="{{ route('admin.menus.pdf', $menu->id) }}" class="btn btn-outline-success">
                            <i class="fas fa-file-pdf"></i> Télécharger PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- The Modal -->
<div id="myModal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="img01">
    <div id="caption"></div>
</div>

@endsection

@section('scripts')
<script>
    function afficherImageAgrandie(src) {
        var modal = document.getElementById("myModal");
        var modalImg = document.getElementById("img01");
        modal.style.display = "block";
        modalImg.src = src;
    }

    var span = document.getElementsByClassName("close")[0];
    span.onclick = function() {
        var modal = document.getElementById("myModal");
        modal.style.display = "none";
    }
</script>
@endsection

@section('extra_styles')
<style>
    /* Styles pour le modal */
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.8);
    }

    .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        animation: zoom 0.6s;
    }

    @keyframes zoom {
        from {transform: scale(0)}
        to {transform: scale(1)}
    }

    .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
    }

    .close:hover,
    .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }

    .custom-bg-color {
        background-color: #f8f9fa; /* Couleur de fond personnalisée */
        border-radius: 5px;
    }
</style>
@endsection
