<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restolink | {{ $restaurant->name }}</title>
    {{-- <link href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet"> --}}
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">


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
        /* Quantity controls */
        .quantity-controls {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin-top: 10px;
        }

        .quantity-controls button {
            border: none;
            background-color: #1e1136;
            color: white;
            font-size: 1.2rem;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .quantity-controls span {
            font-size: 1.2rem;
            margin: 0 10px;
        }

        /* Pour les grands écrans - Disposition par défaut */
        .menu-details {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
        }

        /* Pour les petits écrans - Empiler le prix et la quantité verticalement */
        @media (max-width: 768px) {
            .menu-details {
                display: flex;
                flex-direction: column;
                /* Disposition verticale */
                align-items: flex-start;
            }

            .menu-details img {
                margin-bottom: 10px;
                /* Ajoute de l'espace entre l'image et le reste */
            }

            .prix {
                margin-bottom: 30px;
                /* Ajoute de l'espace entre le prix et la section quantité */
            }

            .quantity-controls {
                align-self: flex-start;
                /* Aligne la section de quantité à gauche */
            }
        }


        * {
            font-family: Georgia, serif;
        }

        .d-none {
            display: none !important;
        }

        .menu-item {
            padding: 15px 0;
        }

        .menu-item .col-md-4 {
            display: flex;
            align-items: center;
            /* Centre tous les éléments verticalement */
            justify-content: space-between;
            gap: 10px;
            /* Ajoute un espacement entre les éléments */
            height: 100%;
            /* S'assure que la hauteur est suffisante pour l'alignement */
        }

        .plat-image {
            max-width: 100px;
            /* Ajuste la taille de l'image selon vos besoins */
            border-radius: 8px;
            flex-shrink: 0;
            /* Empêche l'image de se réduire */
            align-self: center;
            /* Centre l'image verticalement */
        }

        /* .btn-add-to-cart {
            align-self: center;
            /* Centre le bouton verticalement */
        margin-left: 10px;
        /* Ajoute un petit espace après l'image */
        /* } */



        @media (max-width: 768px) {
            .prix {
                align-items: right;

            }

            .menu-item .col-md-4 {
                flex-direction: row;
                /* Affiche les éléments en ligne sur mobile */
                justify-content: space-between;
                /* Espace les éléments entre eux */
                align-items: center;
                /* Aligne les éléments au centre verticalement */
                flex-wrap: nowrap;
                /* Empêche le wrapping des éléments */
            }

            /* .menu-item .col-md-4 img,
            /* .menu-item .col-md-4 .btn-add-to-cart {
                align-self: center;
                /* Centre les images et les boutons verticalement */



            .menu-item .col-md-8 {
                margin-bottom: 10px;
                /* Espace entre les descriptions et l'image en mode mobile */
            }
        }



        /* Modal Header */
        .modal-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #ddd;
            padding: 1rem;
        }

        .modal-title {
            font-size: 1.25rem;
            font-weight: bold;
        }

        /* Form Group */
        .form-group {
            margin-bottom: 1rem;
        }

        /* Form Labels */
        .form-group label {
            font-weight: bold;
            color: #333;
        }

        /* Form Control */
        .form-control {
            border-radius: 0.25rem;
            border: 1px solid #ced4da;
            padding: 0.75rem 1.25rem;
        }

        /* Button */
        .btn-warning {
            background-color: #f0ad4e;
            border-color: #f0ad4e;
            color: #fff;
        }

        .btn-warning:hover {
            background-color: #ec971f;
            border-color: #d58512;
        }

        /* Error Messages */
        .text-danger {
            color: #dc3545;
            font-size: 0.875rem;
        }

        /* Modal Close Button */
        .close-bar {
            cursor: pointer;
            position: absolute;
            top: 0;
            right: 0;
            padding: 0.5rem;
            background-color: #f8f9fa;
            border: none;
        }

        .close-bar span {
            display: block;
            width: 1.5rem;
            height: 1.5rem;
            background-color: #dc3545;
            border-radius: 50%;
            color: #fff;
            text-align: center;
            line-height: 1.5rem;
            font-weight: bold;
        }

        /* Calendar Input */
        .pickadate {
            position: relative;
        }

        .pickadate .picker__header {
            background-color: #007bff;
            color: #fff;
        }

        .pickadate .picker__nav {
            background-color: #dcb310;
        }

        .pickadate .picker__day--selected {
            background-color: #dba608;
            color: #fff;
        }





        /* Style pour la sidebar */
        .sidebar {
            position: fixed;
            top: 46px;
            left: -300px;
            /* Initialement caché en dehors de l'écran */
            width: 215px;
            /* Largeur de la sidebar, ajustée pour correspondre à celle du modal */
            height: 89%;
            background: #fff;
            /* Couleur de fond */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            /* Ombre pour le sidebar */
            transition: left 0.3s ease;
            /* Animation pour le slide */
            z-index: 1050;
            /* Assurez-vous que le sidebar est au-dessus du contenu */
            border-top-right-radius: 10%;
        }

        /* Style pour la sidebar lorsqu'elle est active */
        .sidebar.active {
            left: 0;
            /* Lorsque la classe 'active' est ajoutée, le sidebar est visible */
        }

        /* Style pour le bouton de fermeture du sidebar */
        .close-sidebar {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            background: transparent;
            border: none;
            font-size: 1.5rem;
            /* Taille du texte pour le bouton */
            color: #333;
            /* Couleur du texte */
        }

        /* Style pour les éléments de la catégorie dans le sidebar */
        .category-list .item-title {
            padding: 15px;
            cursor: pointer;
            font-weight: bold;

        }

        /* Style pour la catégorie active */
        .category-list .item-title.active {
            background-color: #007bff;
            /* Couleur de fond pour la catégorie active (bleu Bootstrap) */
            color: #fff;
            /* Couleur du texte pour la catégorie active */
        }

        /* Style pour la liste des plats dans le sidebar */
        .menu-list {
            padding: 10px;
        }


        .text-green {
            color: green;
        }

        /* .btn-add-to-cart {
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
        } */

        /* .btn-add-to-cart:hover {
            transform: scale(1.1);
        } */

        /* .btn-add-to-cart strong {
            color: black;
        } */

        /* .btn-add-to-cart svg {
            width: 24px;
            height: 24px;
        } */


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
            max-width: 700px;
            /* Ajuste ici la largeur maximale */
            width: 100%;
            /* S'assure qu'il prend 100% de l'espace disponible */
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

        /* Alignement des éléments des catégories */
        .widget-menu-tab {
            display: flex;
            justify-content: center;
            list-style: none;
            padding: 0;
            margin: 0;
            overflow-x: auto;
        }


        /* Hover effect */
        .widget-menu-tab .item-title:hover {
            background-color: #e0e0e0;
            color: #1a1034;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        /* Style de la ligne des catégories */
        .widget-menu-tab .item-title {
            cursor: pointer;
            margin-right: 10px;
            padding: 8px 15px;
            border-radius: 20px;
            background-color: #f5f5f5;
            color: #1a1034;
            /* Couleur par défaut pour les catégories inactives */
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Style pour la catégorie active avec fond mauve et texte blanc */
        .widget-menu-tab .item-title.active {
            background: linear-gradient(45deg, #1a1034, #524b82);
            /* Fond mauve dégradé */
            color: #ffffff !important;
            /* Forcer le texte blanc pour la catégorie active */
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        /* Container des catégories */
        .category-container {
            overflow-x: auto;
            white-space: nowrap;
            position: sticky;
            top: 0;
            background: #fff;
            z-index: 10;
            padding: 10px 0;
            border-bottom: 2px solid #f7f7f7;
        }

        /* Style des scrollbar */
        .category-container::-webkit-scrollbar {
            height: 6px;
        }

        .category-container::-webkit-scrollbar-thumb {
            background-color: #ccc;
            border-radius: 10px;
        }

        .category-container::-webkit-scrollbar-thumb:hover {
            background-color: #888;
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

        .wrapper {
            height: 30px;
            min-width: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(45deg, #1a1034, #524b82);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        }

        .wrapper span {
            width: 20%;
            text-align: center;
            font-size: 10px;
            font-weight: 600;
            cursor: pointer;
            user-select: none;
        }

        .wrapper span.num {
            font-size: 15px;
            border-right: 1px solid rgba(255, 255, 255, 0.509);
            border-left: 1px solid rgba(255, 255, 255, 0.509);
            pointer-events: none;
        }

        .timer-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .timer-circle {
            position: relative;
            width: 150px;
            height: 150px;
            background: #e0e0e0;
            border-radius: 50%;
            box-shadow: 9px 9px 16px #bebebe, -9px -9px 16px #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .timer-progress {
            position: absolute;
            width: 100%;
            height: 100%;
            background: conic-gradient(#524b82 0deg, #e0e0e0 0deg);
            border-radius: 50%;
            z-index: 1;
            transition: background 0.5s linear;
        }

        .timer-text {
            position: relative;
            font-size: 1.5rem;
            color: #1a1034;
            font-weight: bold;
            z-index: 2;
        }


        .social-icons-container {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin: 20px auto;
            max-width: 400px;
        }

        .circle {
            width: 60px;
            height: 60px;
            background: #e0e0e0;
            border-radius: 50%;
            box-shadow: 9px 9px 16px #bebebe, -9px -9px 16px #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: transform 0.3s ease;
            text-decoration: none;
        }

        .circle i {
            font-size: 24px;
            color: #352e66;
        }

        .circle:hover {
            transform: scale(1.1);
            box-shadow: 6px 6px 12px #bebebe, -6px -6px 12px #ffffff;
            text-decoration: none;
        }

        .google-review-container {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #c98b06;
            /* Couleur dorée */
            color: #1a1034;
            /* Couleur du texte */
            padding: 10px 20px;
            border-radius: 10px;
            border: 1px solid;
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.1),
                -5px -5px 10px rgba(255, 255, 255, 0.7);
            max-width: 300px;
            margin: 20px auto;
            font-weight: bold;
            font-family: Arial, sans-serif;
            text-decoration: none;
        }

        .google-review-container i {
            margin-top: 2px;
            font-size: 20px;
            margin-right: 10px;
            color: #000000;
            /* Couleur de l'icône Google */
        }

        .google-review-container span {
            font-size: 16px;
            color: #1a1034;
            /* Assurez-vous que la couleur reste la même */
        }

        .google-review-container:hover {
            background-color: #b37400;
            /* Légère modification de la couleur dorée au survol */
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2),
                -5px -5px 10px rgba(255, 255, 255, 0.8);
            text-decoration: none;
        }

        /* Remove text decoration and ensure color remains the same on hover */
        .google-review-container:hover span {
            text-decoration: none;
            color: #1a1034;
            /* Assurez-vous que la couleur reste la même */
        }

        /* Override default link color */
        .google-review-container:link,
        .google-review-container:visited {
            color: #1a1034;
            /* Assurez-vous que la couleur reste la même */
            text-decoration: none;
        }


        @media (max-width: 576px) {

            /* Ajustement des icônes de réseaux sociaux pour mobile */
            .social-icons-container {
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
                margin-top: 15px;
            }

            .social-icons-container .circle {
                width: 35px;
                /* Réduire la taille des cercles */
                height: 35px;
                margin: 5px;
                /* Ajuster l'espacement autour des icônes */
                font-size: 1.2rem;
                /* Ajuster la taille des icônes */
                display: flex;
                justify-content: center;
                align-items: center;
                border-radius: 50%;
            }

        }



        .go-to-cart {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 10px 20px;
            background-color: #1a1034;
            color: #fff;
            border-radius: 50px;
            z-index: 1000;
            opacity: 0;
            transition: opacity 0.5s, transform 0.5s;
            transform: translateX(100%);
        }

        .go-to-cart {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 10px 20px;
            background-color: #1a1034;
            color: #fff;
            border-radius: 50px;
            z-index: 1000;
            opacity: 0;
            transform: translateX(100%);
            transition: opacity 0.5s, transform 0.5s;
        }

        .go-to-cart.show {
            opacity: 1;
            transform: translateX(0);
        }

        .go-to-cart:hover {
            background-color: #352e66;
            /* Couleur de fond au survol */
        }

        @keyframes fadeInRight {
            0% {
                opacity: 0;
                transform: translateX(100%);
            }

            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .fade-in-right {
            animation: fadeInRight 0.6s ease-out;
        }

        .btn-go-to-cart {
            transition: opacity 0.6s ease-out;
        }

        .product-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px;
            background-color: white;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .product-item img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 10px;
        }

        .product-details {
            flex: 1;
            margin-left: 15px;
        }

        .product-details h5 {
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: #1a1034;
        }

        .product-details p {
            font-size: 1rem;
            color: #6c757d;
            margin-bottom: 10px;
        }

        .product-price {
            text-align: right;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .price {
            font-size: 1rem;
            color: #1e1136;
            font-weight: bold;
            margin-bottom: 10px;
            justify-content: right;
        }

        .btn-add-to-cart {
            width: 60%;
            background-color: #1e1136;
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 1rem;
            transition: background-color 0.3s ease;
            justify-content: right;
        }


        /* Responsive Design */
        @media (max-width: 768px) {

            /* Keep the flex layout for smaller screens */
            .product-item {
                flex-direction: row;
                /* Keep horizontal layout */
                align-items: center;
                justify-content: space-between;
            }

            /* Adjust image size for smaller screens */
            .product-item img {
                width: 80px;
                /* Smaller image width */
                height: 80px;
            }

            /* Adjust text alignment */
            .product-details {
                margin-left: 10px;
            }

            .product-price {
                margin-left: auto;
            }



            .btn-add-to-cart {
                width: 60%;
                background: linear-gradient(45deg, #1a1034, #524b82);
                color: white;
                margin-left: 30%;
                border-radius: 25px;
                font-size: 1rem;
                transition: background-color 0.3s ease;
                justify-content: right;
            }
        }

        @media (max-width: 768px) {
        .card-title {
            font-size: 1.2rem; /* Ajuster la taille de la police sur mobile */
        }
        .card-header {
            padding: 8px; /* Ajuster le padding des en-têtes sur mobile */
        }
        .icon-right {
            font-size: 0.8rem; /* Ajuster la taille de l'icône sur mobile */
        }
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-dark" style="background: linear-gradient(45deg, #1a1034, #524b82);">
        <div class="container-fluid d-flex justify-content-between align-items-center">

            <a href="{{ url('restaurant/' . $restaurant->id) }}" class="navbar-brand">
                {{-- @if ($restaurant->logo)
                    <img src="{{ Storage::url($restaurant->logo) }}" alt="Logo" class="img-thumbnail mt-2" width="100">
                @endif --}}
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

    <div class="card mb-0 w-100" style="height: 100vh;">
        <img src="{{ asset('assets/images/post/post1.jpg') }}" class="card-img-top" alt="..." style="object-fit: cover; width: 100%; height: 50%;">
        <div class="card-body" style="height: 50%; display: flex; flex-direction: column; justify-content: space-between;">
            <h5 class="card-title" style="color: linear-gradient(45deg, #1a1034, #524b82); font-size: 1.5rem;">
                {{ $restaurant->name }}
            </h5>
            <div class="accordion" id="menuAccordion" style="flex-grow: 1;">
                <div class="card bordered-section">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="modal" data-target="#modalExcellent">
                        <div class="card-header" id="headingExcellent">
                            <i class="fa fa-star" style="color: #1a1034;"></i>
                            <span style="margin-left: 10px; color: #1a1034;">4.7 - Excellent</span>
                            <br>38 notes
                            <i class="fas fa-chevron-right icon-right" style="color: #1a1034;"></i>
                        </div>
                    </button>
                </div>
                <div class="card bordered-section">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="modal" data-target="#modalInfo">
                        <div class="card-header" id="headingInfo">
                            <i class="fa fa-info-circle" style="color: #1a1034;"></i>
                            <span style="margin-left: 10px;">Info</span>
                            <br>Téléphone et Adresse
                            <i class="fas fa-chevron-right icon-right" style="color: #1a1034;"></i>
                        </div>
                    </button>
                </div>
                <div class="card bordered-section">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="modal" data-target="#modalPlats">
                        <div class="card-header" id="headingOne">
                            <i class="fa fa-utensils" style="color: #1a1034;"></i>
                            <span style="margin-left: 10px;">Menus et Plats</span>
                        </div>
                    </button>
                </div>
                <div class="card bordered-section">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="modal" data-target="#modalPizzas">
                        <div class="card-header" id="headingTwo" style="color: #1a1034;">
                            <i class="fa fa-calendar"></i>
                            <span style="margin-left: 10px;">Réservation</span>
                        </div>
                    </button>
                </div>
            </div>
            <button class="btn btn-block mt-3" style="background-color: #1a1034;">
                <span style="color: #ddd">Évaluez votre expérience</span>
            </button>
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

    <!-- Modal pour afficher les informations du restaurant -->
    <div class="modal fade" id="modalInfo" tabindex="-1" role="dialog" aria-labelledby="modalInfoLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="close-bar" data-dismiss="modal"><span></span></div>
                {{-- <div class="modal-header">
                    <h5 class="modal-title" id="modalInfoLabel">Informations du Restaurant</h5>
                </div> --}}
                <div class="modal-body p-4">
                    <!-- Card Profil du Restaurant -->
                    <div class="card profile-card shadow-sm mb-4 bg-white rounded"
                        style="border: none; max-width: 100%; overflow: hidden;">

                        <!-- Logo du Restaurant -->
                        <div class="d-flex justify-content-center align-items-center p-3"
                            style="background: linear-gradient(45deg, #1a1034, #524b82);">
                            @if ($restaurant->logo)
                                <img src="{{ Storage::url($restaurant->logo) }}" alt="Logo du Restaurant"
                                    class="rounded-circle shadow-sm"
                                    style="width: 90px; height: 90px; object-fit: cover; border: 1px solid #a6a6a6;">
                            @endif
                        </div>

                        <!-- Contenu de la Carte -->
                        <div class="card-body text-center">
                            <!-- Nom du Restaurant -->
                            <h4 class="card-title" style="color: #1a1034; font-weight: 600; margin-top: 15px;">
                                {{ $restaurant->name }}</h4>

                            <h6 class="card-subtitle mb-2 text-muted">
                                Restaurant
                            </h6>
                            <hr>
                            Votre commande vous sera livrée dans :
                            <br>
                            <div class="timer-container mt-4">
                                <div class="timer-circle">
                                    <div class="timer-progress" id="timer-progress"></div>
                                    <div class="timer-text" id="timer-text">00:00</div>
                                </div>
                            </div>





                            <div class="social-icons-container">
                                <a href="https://www.facebook.com" class="circle" target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="https://www.twitter.com" class="circle" target="_blank">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="https://www.instagram.com" class="circle" target="_blank">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="https://www.linkedin.com" class="circle" target="_blank">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="https://www.youtube.com" class="circle" target="_blank">
                                    <i class="fab fa-youtube"></i>
                                </a>
                            </div>

                            <a href="https://www.google.com/search?q={{ urlencode($restaurant->name) }}+{{ urlencode($restaurant->address) }}&lrd=0x...#lrd=0xec1729ca1bf2a41:0x7c056ce772b26119,3,,,,"
                                target="_blank" class="google-review-container">
                                <i class="fab fa-google"></i>
                                <span>Laissez-nous votre avis</span>
                            </a>


                            <hr>

                            <!-- Adresse -->
                            <h6 class="card-subtitle mb-2 text-muted">
                                <i class="fas fa-map-marker-alt" style="color: #524b82; margin-right: 5px;"></i>
                                {{ $restaurant->address }}
                            </h6>

                            <!-- Horaire -->
                            <p class="card-text mt-3 text-muted">
                                <i class="fas fa-clock" aria-hidden="true"
                                    style="color: #524b82; margin-right: 5px;"></i>
                                <strong>Horaire :</strong>
                                <span style="color: #1a1034; display: block; font-size: 0.9rem; font-weight: 500;">De
                                    {{ $restaurant->opening_time }} à {{ $restaurant->closing_time }}</span>
                            </p>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <!-- Votre modal ici -->
    <div class="modal fade" id="modalPlats" tabindex="-1" role="dialog" aria-labelledby="modalPlatsLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="close-bar" data-dismiss="modal"><span></span></div>
                <div class="modal-header">
                    <h5 style="margin-top: 2%;" class="modal-title" id="modalPlatsLabel">
                        <svg id="openSidebar" style="color: #1a1034;" xmlns="http://www.w3.org/2000/svg"
                            width="28" height="28" fill="currentColor" class="bi bi-list-ul"
                            viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m-3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2m0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2m0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2" />
                        </svg>
                    </h5>
                    <div class="category-container">
                        <ul class="widget-menu-tab d-flex">
                            <li class="item-title active" data-filter="*"><span class="inner"><strong>Tout
                                        afficher</strong></span></li>
                            @foreach ($categories as $category)
                                <li class="item-title" data-filter=".filter-{{ $category->id }}">
                                    <span class="inner"><strong>{{ $category->name }}</strong></span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
                <div class="modal-body">
                    <div id="sidebar" class="sidebar">
                        <button id="closeSidebar" class="close-sidebar">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                <path
                                    d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                            </svg>
                        </button>

                        <ul class="category-list">
                            <li class="item-title" data-filter="*" onclick="filterMenuItems('*')"><strong>Tout
                                    afficher</strong></li>
                            @foreach ($categories as $category)
                                <li class="item-title" data-filter=".filter-{{ $category->id }}"
                                    onclick="filterMenuItems('filter-{{ $category->id }}')">
                                    <strong>{{ $category->name }}</strong>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- Liste des plats -->
                    <div class="menu-list">
                        <div class="pdf-link text-center">
                            <a href="{{ route('restaurant.menu.pdf', ['id' => $lastMenu->id]) }}"
                                class="btn btn-rounded btn-light" target="_blank">
                                Voir en <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                    fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM1.6 11.85H0v3.999h.791v-1.342h.803q.43 0 .732-.173.305-.175.463-.474a1.4 1.4 0 0 0 .161-.677q0-.375-.158-.677a1.2 1.2 0 0 0-.46-.477q-.3-.18-.732-.179m.545 1.333a.8.8 0 0 1-.085.38.57.57 0 0 1-.238.241.8.8 0 0 1-.375.082H.788V12.48h.66q.327 0 .512.181.185.183.185.522m1.217-1.333v3.999h1.46q.602 0 .998-.237a1.45 1.45 0 0 0 .595-.689q.196-.45.196-1.084 0-.63-.196-1.075a1.43 1.43 0 0 0-.589-.68q-.396-.234-1.005-.234zm.791.645h.563q.371 0 .609.152a.9.9 0 0 1 .354.454q.118.302.118.753a2.3 2.3 0 0 1-.068.592 1.1 1.1 0 0 1-.196.422.8.8 0 0 1-.334.252 1.3 1.3 0 0 1-.483.082h-.563zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638z" />
                                </svg>
                            </a>
                        </div>
                        @foreach ($plats as $plat)
                            <div class="product-item menu-item filter-{{ $plat->category_id }}">
                                <img src="{{ asset('storage/' . $plat->image_url) }}" alt="Image du plat"
                                    class="rounded img-fluid plat-image mb-2 mb-md-0"
                                    style="max-width: 90px; max-height: 90px;">
                                <div class="product-details">
                                    <h5>{{ $plat->name }}</h5>
                                    <p>{{ $plat->description }}.</p>
                                </div>
                                <div class="product-price">
                                    <p class="price">{{ $plat->price }} F</p>
                                    <button class="btn btn-add-to-cart" data-plat-id="{{ $plat->id }}"
                                        data-restaurant-id="{{ $restaurant->id }}"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-basket2-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M5.929 1.757a.5.5 0 1 0-.858-.514L2.217 6H.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h.623l1.844 6.456A.75.75 0 0 0 3.69 15h8.622a.75.75 0 0 0 .722-.544L14.877 8h.623a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1.717L10.93 1.243a.5.5 0 1 0-.858.514L12.617 6H3.383zM4 10a1 1 0 0 1 2 0v2a1 1 0 1 1-2 0zm3 0a1 1 0 0 1 2 0v2a1 1 0 1 1-2 0zm4-1a1 1 0 0 1 1 1v2a1 1 0 1 1-2 0v-2a1 1 0 0 1 1-1" />
                                        </svg></button>

                                    <div class="quantity-controls d-none" data-plat-id="{{ $plat->id }}">
                                        <button class="btn btn-decrease" data-plat-id="{{ $plat->id }}"
                                            data-restaurant-id="{{ $restaurant->id }}">-</button>
                                        <span id="quantity-{{ $plat->id }}" class="quantity">1</span>
                                        <button class="btn btn-increase" data-plat-id="{{ $plat->id }}"
                                            data-restaurant-id="{{ $restaurant->id }}">+</button>
                                    </div>

                                </div>
                            </div>
                            <hr>
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
                                name="num_people" min="1" max="30" required>
                            <div id="num_people_error" class="text-danger" style="display: none;">
                                Le nombre de personnes par table doit commencer par 1
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="table_id">Sélectionner une table disponible*</label>
                            <select class="form-control" id="table_id" name="table_id" required>
                                <option value="" disabled selected>Choisissez une table</option>
                                @foreach ($tables as $table)
                                    <option value="{{ $table->id }}">Table {{ $table->id }} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="min-date">Date*</label>
                            <input type="text" class="form-control" id="min-date" name="date"
                                placeholder="Set min date" value="{{ date('Y-m-d') }}" required>
                        </div>

                        <div class="form-group">
                            <button class="btn  w-100" type="submit" style="background-color: #1e192d;"><span
                                    class="fs-21" style="color: #fff">Réserver</span></button>
                        </div>
                    </form>

                    <div id="error-messages" class="text-danger"></div>
                </div>
            </div>
        </div>
    </div>


    <a href="{{ url('cart/' . $restaurant->id) }}" class="btn btn-primary go-to-cart d-none">
        Valider <svg style="margin-left: 2%" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
            fill="currentColor" class="bi bi-cart-dash-fill" viewBox="0 0 16 16">
            <path
                d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0M6.5 7h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1 0-1" />
        </svg>
    </a>


    <!-- SweetAlert2 CSS -->


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            // Vérifier si le paramètre de requête 'success' est présent
            if (new URLSearchParams(window.location.search).has('success')) {
                Swal.fire({
                    title: 'Commande réussie!',
                    text: 'Pour connaitre le temps de préparation de votre commande, vous pouvez suivre le minuteur dans la section Infos. Bon appétit  !',
                    icon: 'info',
                    confirmButtonText: 'Compris'
                });
            }
        });
    </script>



    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Récupérer l'heure d'expiration depuis le backend (format ISO)
            const expirationTime = '{{ session('timer_expiration_time') }}';

            if (expirationTime) {
                const endTime = new Date(expirationTime).getTime();
                const timerText = document.getElementById('timer-text');
                const timerProgress = document.getElementById('timer-progress');

                // Définir la durée totale en millisecondes
                const totalTime = endTime - new Date().getTime();

                // Fonction pour mettre à jour le minuteur
                function updateTimer() {
                    const now = new Date().getTime();
                    const timeRemaining = endTime - now;

                    if (timeRemaining > 0) {
                        const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
                        const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

                        // Afficher les minutes et secondes
                        timerText.innerHTML = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;

                        // Calculer le pourcentage de temps écoulé
                        const timeElapsedPercent = ((totalTime - timeRemaining) / totalTime) * 100;

                        // Déterminer la couleur de dégradé en fonction du temps écoulé
                        const startColor = [82, 75, 130]; // Mauve initial (en RGB)
                        const endColor = [0, 128, 0]; // Vert final (en RGB)

                        // Interpoler les couleurs entre startColor et endColor
                        const currentColor = startColor.map((start, i) => {
                            return Math.floor(start + (endColor[i] - start) * (timeElapsedPercent / 100));
                        });

                        // Appliquer le dégradé au cercle
                        timerProgress.style.background =
                            `conic-gradient(rgb(${currentColor[0]}, ${currentColor[1]}, ${currentColor[2]}) ${timeElapsedPercent}deg, #e0e0e0 0deg)`;
                    } else {
                        // Le temps est écoulé
                        timerText.innerHTML = "00:00";
                        timerProgress.style.background = "conic-gradient(#68b333 360deg, #68b333 0deg)"; // Vert
                        clearInterval(timerInterval);
                    }
                }

                // Lancer la mise à jour du minuteur immédiatement pour éviter l'attente d'une seconde
                updateTimer();

                // Mettre à jour le minuteur toutes les secondes
                const timerInterval = setInterval(updateTimer, 1000);
            } else {
                console.error('Aucune heure d\'expiration trouvée dans la session.');
            }
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sélectionner le bouton SVG et le sidebar
            const openSidebarBtn = document.getElementById('openSidebar');
            const sidebar = document.getElementById('sidebar');
            const closeSidebarBtn = document.getElementById('closeSidebar');

            // Fonction pour ouvrir le sidebar
            openSidebarBtn.addEventListener('click', function() {
                sidebar.classList.add('active'); // Ajouter une classe 'active' pour montrer le sidebar
            });

            // Fonction pour fermer le sidebar
            closeSidebarBtn.addEventListener('click', function() {
                sidebar.classList.remove('active'); // Retirer la classe 'active' pour masquer le sidebar
            });
        });

        // Filtrage des plats par catégorie
        function filterMenuItems(category) {
            var items = document.querySelectorAll('.menu-item');

            items.forEach(function(item) {
                if (category === '*' || item.classList.contains(category)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        }
    </script>

    <script>
        $('.btn-add-to-cart').click(function(e) {
            e.preventDefault();

            var platId = $(this).data('plat-id');
            var restaurantId = $(this).data('restaurant-id');

            var $button = $(this);

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

                    // Remplacer le bouton par le SVG uniquement pour masquer le badge
                    $button.removeClass('btn btn-primary')
                        .addClass('d-none'); // Masquer le bouton d'ajout au panier

                    // Affichez les contrôles de quantité
                    $('.quantity-controls[data-plat-id="' + platId + '"]').removeClass('d-none');

                    // Affichez le bouton "Aller au panier" avec animation
                    if (response.cartCount > 0) {
                        $('.go-to-cart')
                            .removeClass('d-none')
                            .addClass('fade-in-right show');
                    }

                    Swal.fire({
                        icon: 'success',
                        title: 'Succès!',
                        text: 'Plat ajouté au panier avec succès!',
                        timer: 1500,
                        showConfirmButton: false
                    });
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


        $(document).on('click', '.btn-increase', function(e) {
            e.preventDefault();

            var platId = $(this).data('plat-id');
            var restaurantId = $(this).data('restaurant-id');

            $.ajax({
                url: '{{ route('update.cart.quantity') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: platId,
                    restaurant_id: restaurantId,
                    quantity: 1 // Augmentation de 1
                },
                success: function(response) {
                    // Mise à jour de la quantité dans le DOM
                    var quantity = parseInt($('#quantity-' + platId).text()) + 1;
                    $('#quantity-' + platId).text(quantity);
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        text: 'Impossible de mettre à jour la quantité. Veuillez réessayer.'
                    });
                }
            });
        });


        $(document).on('click', '.btn-decrease', function(e) {
            e.preventDefault();

            var platId = $(this).data('plat-id');
            var restaurantId = $(this).data('restaurant-id');

            $.ajax({
                url: '{{ route('update.cart.quantity') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: platId,
                    restaurant_id: restaurantId,
                    quantity: -1 // Diminution de 1
                },
                success: function(response) {
                    var quantity = parseInt($('#quantity-' + platId).text()) - 1;

                    if (quantity > 0) {
                        $('#quantity-' + platId).text(quantity);
                    } else {
                        // Si la quantité tombe à 0, cacher les contrôles et réactiver le bouton d'ajout au panier
                        $('.quantity-controls[data-plat-id="' + platId + '"]').addClass('d-none');

                        // Remettre le bouton initial d'ajout au panier
                        var $button = $('.btn-add-to-cart[data-plat-id="' + platId + '"]');
                        $button.removeClass('badge badge-info')
                            .addClass('btn btn-primary')
                            .html('<strong>+</strong>')
                            .prop('disabled', false);
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        text: 'Impossible de mettre à jour la quantité. Veuillez réessayer.'
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
                    `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}`
                );
                const data = await response.json();
                if (data && data.length > 0) {
                    const lat = data[0].lat;
                    const lng = data[0].lon;
                    initMap(lat, lng);
                } else {
                    console.error("Adresse non retrouvée");
                }
            }

            // Initialize the map when the modal is shown
            $('#modalInfo').on('shown.bs.modal', function() {
                geocodeAddress("{{ $restaurant->address }}");
            });
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

                var currentCategory;
                $('.menu-item').each(function() {
                    var elementTop = $(this).offset().top - $(this).closest('.modal-body').offset()
                        .top + scrollTop;
                    var elementBottom = elementTop + $(this).height();

                    if (elementTop <= scrollBottom && elementBottom >= scrollTop) {
                        var category = $(this).attr('class').split(' ').find(c => c.startsWith(
                            'filter-'));
                        var filterValue = '.' + category;
                        $('.widget-menu-tab .item-title').removeClass('active');
                        $('.widget-menu-tab .item-title[data-filter="' + filterValue + '"]')
                            .addClass('active');

                        // Scrolling the category container to ensure the active category is visible
                        var $activeCategory = $('.widget-menu-tab .item-title.active');
                        var containerScrollLeft = $activeCategory.position().left + $(
                            '.category-container').scrollLeft();
                        $('.category-container').animate({
                            scrollLeft: containerScrollLeft
                        }, 300);

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

            if (numPeople.value < 1 || numPeople.value > 100) {
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
                min: new Date(), // Définition de la date minimale comme étant aujourd'hui
                selectYears: true, // Optionnel: Ajoute la sélection d'années
                selectMonths: true, // Optionnel: Ajoute la sélection de mois
                today: 'Aujourd\'hui', // Texte pour le bouton "Aujourd'hui"
                clear: 'Effacer', // Texte pour le bouton "Effacer"
                close: 'Fermer' // Texte pour le bouton "Fermer"
            });
        });

        // Gestion de la soumission du formulaire
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

        $(document).ready(function() {
            // Lorsque le modal est masqué (fermé)
            $('#modalPlats').on('hidden.bs.modal', function() {
                // Vérifier si l'URL est correcte
                alert("Redirection vers : " + "{{ url('cart/' . $restaurant->id) }}");

                // Rediriger vers la page du panier
                window.location.href = "{{ url('cart/' . $restaurant->id) }}";
            });
        });
    </script>



</body>

</html>
