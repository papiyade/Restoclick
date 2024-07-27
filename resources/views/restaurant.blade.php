<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restolink | {{ $restaurant->name }}</title>
    <link href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/vendor/pickadate/themes/default.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/pickadate/themes/default.date.css') }}">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.min.css">

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.min.js"></script>



    <style>
        .text-green {
            color: green;
        }

        .btn-add-to-cart {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: white;
            border: none;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            position: absolute;
            bottom: 10px;
            margin-left: 27%;
            transition: transform 0.2s ease;
        }

        .btn-add-to-cart:hover {
            transform: scale(1.1);
        }

        .btn-add-to-cart strong {
            color: black;
        }

        .btn-add-to-cart svg {
            width: 24px;
            height: 24px;
        }


        .position-absolute {
            position: absolute;
        }




        .icon-right {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
        }

        .bordered-section .btn-link {
            text-decoration: none;
            color: black;
        }

        .modal-dialog-centered {
            display: flex;
            align-items: center;
            min-height: calc(100% - 1rem);
        }

        .modal-lg-centered {
            max-width: 80%;

        }


        .close-bar {
            width: 100%;
            height: 30px;
            border-radius: 15px 15px 0 0;
            background: rgba(113, 113, 113, 0.15);
            text-align: center;
            cursor: pointer;
        }

        .close-bar span {
            display: inline-block;
            background: rgba(0, 0, 0, 0.8);
            width: 60px;
            height: 5px;
            border-radius: 5px;
            margin-top: 12px;
        }

        .plat-image {
            position: relative;
            width: 50%;

            height: auto;
            display: inline-block;
            transition: transform 0.9s ease;
        }


        .widget-menu-tab {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
            overflow-x: auto;
        }

        .widget-menu-tab .item-title {
            cursor: pointer;
            margin-right: 10px;
            padding: 5px 10px;
            border-bottom: 2px solid transparent;
            transition: border-bottom 0.3s ease;
        }

        .widget-menu-tab .item-title.active {
            border-bottom: 6px solid black;
        }

        .category-container {
            overflow-x: auto;
            white-space: nowrap;
        }

        .modal-header {
            position: sticky;
            top: 0;
            background-color: white;
            z-index: 1;
            border-bottom: none;
        }

        .modal-body {
            max-height: 70vh;
            overflow-y: auto;
        }



        .badge-success {
            background-color: green;
            color: white;
            border: none;
        }

        .modal-content {
            border-radius: 15px 15px 0 0;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <a href="{{ url('restaurant/' . $restaurant->id) }}" class="navbar-brand">
                <h3 style="font-family: Arial">
                    {{ $restaurant->name }}
                </h3>
            </a>
            <div class="d-flex align-items-center">
                @php
                    $totalQuantity = 0;
                    $cartKey = "cart_{$restaurant->id}";
                @endphp

                @if (session($cartKey))
                    @foreach (session($cartKey) as $item)
                        @php
                            $totalQuantity += $item['quantity'];
                        @endphp
                    @endforeach
                @endif

                <div class="dropdown">
                    <a class="btn btn-outline-dark custom-cart-btn border border-light"
                        href="{{ url('cart/' . $restaurant->id) }}" style="text-decoration: none;">

                        <span class="custom-cart-text">
                            <svg style="color: #ffffff" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                fill="currentColor" class="bi bi-cart-dash-fill" viewBox="0 0 16 16">
                                <path
                                    d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0M6.5 7h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1 0-1" />
                            </svg>
                        </span>
                        <span class="badge bg-warning" id="cart-quantity">{{ $totalQuantity }}</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    {{-- <a href="{{ route('webmaster-resto') }}">Tous les Restaurants</a> --}}



    <div class="card mb-0">
        <img src="{{ asset('assets/images/post/post1.jpg') }}" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title"> {{ $restaurant->name }} </h5>
            <div class="accordion" id="menuAccordion">

                <div class="card bordered-section">
                    <button class="btn btn-link btn-block text-left" style="width: 100%" type="button"
                        data-toggle="modal" data-target="#modalExcellent">
                        <div class="card-header" id="headingExcellent">
                            <i class="fa fa-star"></i> <span style="margin-left: 10px;">4.7 - Excellent</span>
                            <br>38 notes
                            <i class="fas fa-chevron-right icon-right"></i>
                        </div>
                    </button>
                </div>

                <div class="card bordered-section ">
                    <button class="btn btn-link btn-block text-left" style="width: 100%" type="button"
                        data-toggle="modal" data-target="#modalInfo">
                        <div class="card-header" id="headingInfo">
                            <i class="fa fa-info-circle"></i> <span style="margin-left: 10px;">Info</span>
                            <br> Téléphone et Adresse
                            <i class="fas fa-chevron-right icon-right"></i>
                        </div>
                    </button>
                </div>

                <div class="card bordered-section">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="modal"
                        data-target="#modalPlats">
                        <div class="card-header" id="headingOne">
                            <i class="fa fa-utensils"></i> <span style="margin-left: 10px;">Menus et Plats</span>
                        </div>
                    </button>
                </div>

                <div class="card bordered-section">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="modal"
                        data-target="#modalPizzas">
                        <div class="card-header" id="headingTwo">
                            <i class="fa fa-calendar"></i> <span style="margin-left: 10px;">Réservation</span>
                        </div>
                    </button>
                </div>

                <div class="card bordered-section">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="modal"
                        data-target="#modalVins">
                        <div class="card-header" id="headingThree">
                            <i class="fa fa-wine-glass"></i> <span style="margin-left: 10px;">Vins et bières</span>
                        </div>
                    </button>
                </div>
            </div>
            <button class="btn btn-dark btn-block mt-3">Évaluez votre expérience</button>
        </div>
    </div>

    <!-- Modal Excellent -->
    <div class="modal fade" id="modalExcellent" tabindex="-1" role="dialog" aria-labelledby="modalExcellentLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="close-bar" data-dismiss="modal"><span></span></div>
                <div class="modal-header">
                    <h5 class="modal-title" id="modalExcellentLabel">Détails des évaluations</h5>
                </div>
                <div class="modal-body">
                    Contenu pour les évaluations...
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Info -->
    <div class="modal fade" id="modalPlats" tabindex="-1" role="dialog" aria-labelledby="modalPlatsLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="close-bar" data-dismiss="modal"><span></span></div>
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPlatsLabel">
                        <svg style="margin-top: 8%;" xmlns="http://www.w3.org/2000/svg" width="28"
                            height="28" fill="currentColor" class="bi bi-list-ul" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m-3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2m0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2m0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2" />
                        </svg>
                    </h5>
                    <div class="category-container">
                        <ul class="widget-menu-tab d-flex">
                            <li class="item-title active" data-filter="*">
                                <span class="inner"><strong>Tout afficher</strong></span>
                            </li>
                            @foreach ($categories as $category)
                                <li class="item-title" data-filter=".filter-{{ $category->id }}">
                                    <span class="inner"><strong>{{ $category->name }}</strong></span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="modal-body">
                    <!-- Liste des plats -->
                    <div class="menu-list">
                        @foreach ($plats as $plat)
                            <div class="menu-item filter-{{ $plat->category_id }}">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <h5>{{ $plat->name }}</h5>
                                        <p style="color: #7e7e7e">{{ $plat->description }}</p>
                                        <p><strong>{{ $plat->price }} Fcfa</strong></p>
                                    </div>
                                    <div class="col-md-4 position-relative">
                                        <img src="{{ asset('storage/' . $plat->image_url) }}" alt="Image du plat"
                                            class="img-fluid plat-image">
                                        <button class="btn-add-to-cart" data-plat-id="{{ $plat->id }}"
                                            data-restaurant-id="{{ $restaurant->id }}">
                                            <strong>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                        d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
                                                </svg>
                                            </strong>
                                        </button>

                                    </div>
                                </div>
                                <hr>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modalPlats" tabindex="-1" role="dialog" aria-labelledby="modalPlatsLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="close-bar" data-dismiss="modal"><span></span></div>
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPlatsLabel"><svg style="margin-top: 8%;"
                            xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor"
                            class="bi bi-list-ul" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m-3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2m0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2m0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2" />
                        </svg></h5>
                    <ul class="widget-menu-tab d-flex">
                        <li class="item-title active" data-filter="*">
                            <span class="inner">Tout afficher</span>
                        </li>
                        @foreach ($categories as $category)
                            <li class="item-title" data-filter=".filter-{{ $category->id }}">
                                <span class="inner">{{ $category->name }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="modal-body">
                    <!-- Liste des plats -->
                    <div class="menu-list">
                        @foreach ($plats as $plat)
                            <div class="menu-item filter-{{ $plat->category_id }}">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <h5>{{ $plat->name }}</h5>
                                        <p>{{ $plat->description }}</p>
                                        <p>{{ $plat->price }} Fcfa</p>
                                    </div>
                                    <div class="col-md-4 position-relative">
                                        <img src="{{ asset('storage/' . $plat->image_url) }}" alt="Image du plat"
                                            class="img-fluid plat-image">
                                        <button class="btn btn-dark btn-add-to-cart position-absolute"
                                            style="top: 10px; right: 10px; background-color: rgb(255, 255, 255); border: none;"
                                            data-plat-id="{{ $plat->id }}"
                                            data-restaurant-id="{{ $restaurant->id }}">
                                            <strong>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    style="color: #000" fill="currentColor" class="bi bi-plus-lg"
                                                    viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                        d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
                                                </svg>
                                            </strong>
                                        </button>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Pizzas -->
    <div class="modal fade" id="modalPizzas" tabindex="-1" role="dialog" aria-labelledby="modalPizzasLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="close-bar" data-dismiss="modal"><span></span></div>
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPizzasLabel">Faire une réservation</h5>
                </div>
                <div class="modal-body">
                    <form id="reservationForm" method="POST">
                        @csrf
                        <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">

                        <div class="form-group">
                            <label for="name">Votre nom complet*</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Name*" required>
                        </div>

                        <div class="form-group">
                            <label for="phone_number">Téléphone*</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number"
                                placeholder="Phone*" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Adresse Email*</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Email*" required>
                        </div>

                        <div class="form-group">
                            <label for="time">Heure*</label>
                            <input type="time" class="form-control" id="time" name="time" value="19:00"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="num_people">Nombre de personnes*</label>
                            <input type="number" value="1" class="form-control" id="num_people"
                                name="num_people" min="1" max="5" required oninput="validatePeople()">
                            <div id="num_people_error" class="text-danger" style="display: none;">Le nombre de
                                personnes par table doit être entre 1 et 5</div>
                        </div>

                        <div class="form-group">
                            <label for="min-date">Date*</label>
                            <input type="text" class="form-control" id="min-date" name="date"
                                placeholder="Set min date" value="2024-06-18" required>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-warning w-100" type="submit"><span
                                    class="fs-21">Réserver</span></button>
                        </div>
                    </form>
                    <div id="error-messages" class="text-danger"></div>
                </div>
            </div>
        </div>
    </div>





    <!-- Modal Vins -->
    <div class="modal fade" id="modalVins" tabindex="-1" role="dialog" aria-labelledby="modalVinsLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="close-bar" data-dismiss="modal"><span></span></div>
                <div class="modal-header">
                    <h5 class="modal-title" id="modalVinsLabel">Vins et bières</h5>
                </div>
                <div class="modal-body">
                    Contenu pour Vins et bières...
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 CSS -->


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $('.btn-add-to-cart').click(function(e) {
            e.preventDefault();

            var platId = $(this).data('plat-id');
            var restaurantId = $(this).data('restaurant-id');

            var $button = $(this); // Sélectionnez le bouton actuel

            $.ajax({
                url: '{{ route('add.to.cart') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    plat_id: platId,
                    restaurant_id: restaurantId,
                    quantity: 1
                },
                success: function(response) {
                    $('#cart-quantity').text(response.cartCount);

                    // Remplacez le bouton par un badge
                    $button.removeClass('btn btn-primary')
                        .addClass('badge badge-info')
                        .html('<span class="text-green">Ajouté</span>')
                        .prop('disabled', true);

                    Swal.fire({
                        icon: 'success',
                        title: 'Succès!',
                        text: 'Plat ajouté au panier avec succès!',
                        timer: 1500,
                        showConfirmButton: false
                    });
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        text: 'Une erreur s\'est produite. Veuillez réessayer.'
                    });
                }
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Function to initialize the map
            function initMap(lat, lng) {
                // Create the map
                var map = L.map('map').setView([lat, lng], 13);

                // Add OpenStreetMap tiles
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                // Add a marker
                L.marker([lat, lng]).addTo(map)
                    .bindPopup('{{ $restaurant->name }}')
                    .openPopup();
            }

            // Geocode the restaurant address
            async function geocodeAddress(address) {
                const response = await fetch(
                    `https://nominatim.openstreetmap.org/search?format=json&q=${address}`);
                const data = await response.json();
                if (data && data.length > 0) {
                    const lat = data[0].lat;
                    const lng = data[0].lon;
                    initMap(lat, lng);
                } else {
                    console.error("Address not found");
                }
            }

            // Geocode the restaurant address
            geocodeAddress("{{ $restaurant->address }}");
        });
    </script>



    <script>
        $(document).ready(function() {
            // Handle category click
            $('.widget-menu-tab .item-title').on('click', function() {
                var filterValue = $(this).attr('data-filter');
                $('.widget-menu-tab .item-title').removeClass('active');
                $(this).addClass('active');

                if (filterValue === '*') {
                    $('.menu-item').show();
                } else {
                    $('.menu-item').hide();
                    $(filterValue).show();
                }
            });

            // Handle modal scroll
            $('.modal-body').on('scroll', function() {
                var scrollTop = $(this).scrollTop();
                var scrollBottom = scrollTop + $(this).height();

                $('.menu-item').each(function() {
                    var elementTop = $(this).offset().top;
                    var elementBottom = elementTop + $(this).height();

                    if (elementTop <= scrollBottom && elementBottom >= scrollTop) {
                        var category = $(this).attr('class').split(' ').find(c => c.startsWith(
                            'filter-'));
                        var filterValue = '.' + category;
                        $('.widget-menu-tab .item-title').removeClass('active');
                        $('.widget-menu-tab .item-title[data-filter="' + filterValue + '"]')
                            .addClass('active');
                        return false;
                    }
                });
            });
        });
    </script>



    <script>
        function validatePeople() {
            var numPeople = document.getElementById("num_people");
            var errorDiv = document.getElementById("num_people_error");

            if (numPeople.value < 1 || numPeople.value > 5) {
                errorDiv.style.display = "block";
            } else {
                errorDiv.style.display = "none";
            }
        }

        document.getElementById("num_people").addEventListener("input", validatePeople);
    </script>


    <!-- Pickdate -->
    <script src="{{ asset('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/pickadate/picker.js') }}"></script>
    <script src="{{ asset('assets/vendor/pickadate/picker.time.js') }}"></script>
    <script src="{{ asset('assets/vendor/pickadate/picker.date.js') }}"></script>

    <!-- Pickadate init -->
    <script src="{{ asset('assets/js/plugins-init/pickadate-init.js') }}"></script>




    <script>
        // Initialisation de Pickadate pour le champ #min-date
        $(document).ready(function() {
            $('#min-date').pickadate({
                format: 'yyyy-mm-dd',
                min: new Date() // Définition de la date minimale comme étant aujourd'hui
            });
        });



        $('#reservationForm').on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                url: '{{ route('client.reservation.submit') }}',
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Réservation effectuée avec succès!',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#modalPizzas').modal('hide'); // Fermer le modal
                    $('#reservationForm')[0].reset(); // Réinitialiser le formulaire
                },
                error: function(response) {
                    $('#error-messages').html('');
                    var errors = response.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        $('#error-messages').append('<p>' + value + '</p>');
                    });
                }
            });
        });
    </script>
</body>

</html>
