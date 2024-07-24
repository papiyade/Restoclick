<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurants</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

<!-- Include Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <link href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/css/swiper-bundle.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <!-- AOS CDN -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>


    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        html {
            font-size: 16px;
        }

        body {
            font-family: 'Lato', sans-serif;
            color: var(--primary-text-color);
            background: var(--primary-color);
        }

        /* Navbar */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 4rem;
            display: flex;
            align-items: center;
            padding: 0 10vw;
            z-index: 9;
            background-color: #e1a21a
        }

        .logo {
            height: 1.5rem;
        }

        .links-container {
            display: flex;
            gap: 1rem;
            list-style: none;
            margin-left: 7.5%;
        }

        .links {
            color: var(--primary-text-color);
            text-decoration: none;
            text-transform: capitalize;
            padding: .5rem 1rem;
            transition: .2s;
        }

        /* .links:hover {
            color: var(--secondary-text-color);
        } */

        .nav-extras {
            display: flex;
            align-items: center;
            margin-left: auto;
            gap: 1rem;
        }

        .search {
            position: relative;
            width: 20vw;
            min-width: 150px;
            height: 2.5rem;
            border-radius: .5rem;
            overflow: hidden;
        }

        .search-box {
            width: 100%;
            height: 100%;
            background: var(--primary-color);
            border: none;
            padding: 1rem;
            outline: none;
            font-size: .9rem;
        }

        .search-btn {
            position: absolute;
            border: none;
            right: 0;
            width: 3rem;
            height: 100%;
            background: var(--primary-color);
            text-align: center;
            cursor: pointer;
            color: var(--secondary-text-color);
        }

        .cart {
            width: 2.5rem;
            height: 2.5rem;
            color: var(--secondary-text-color);
            border-radius: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            text-decoration: none;
            transition: .5s;
        }

        /* .cart:hover {
            background: var(--alpha-secondary-color);
        } */

        /* Hero Section */
        #hero-section {
            min-height: 100vh;
            padding: 0 10vw;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--accent-color);
        }

        .hero-content {
            width: 40%;
        }

        .hero-heading {
            font-size: 4rem;
            line-height: 5rem;
            font-weight: 700;
            color: var(--secondary-text-color);
        }

        .hero-line {
            line-height: 2rem;
            opacity: 0.75;
            margin-top: 2rem;
        }

        .search.location {
            width: 100%;
            height: 3.5rem;
            border-radius: .2rem;
            margin: 2.5rem 0;
        }

        .locate-btn {
            font-size: 1.2rem;
            width: 4rem;
            transition: .5s;
        }

        .search.location .search-box {
            padding: 1rem 1.5rem;
        }

        .hero-action-btn-container {
            display: flex;
            align-items: center;
            gap: 2rem;
        }
/*
        .btn {
            padding: 1rem 1.5rem;
            border: none;
            border-radius: .3rem;
            font-size: 1rem;
            color: var(--light-text-color);
            background: var(--secondary-color);
            text-transform: capitalize;
            cursor: pointer;
        }

        .btn.transparent {
            background: transparent;
            border: .1rem solid var(--secondary-color);
            color: var(--secondary-text-color);
        } */

        .hero-action-btn-container .or {
            color: var(--secondary-text-color);
        }

        .hero-img-container {
            min-width: 30rem;
            min-height: 30rem;
            position: relative;
            transform: scale(0.9) translateY(1rem);
        }

        .background-ele {
            width: 100%;
            min-height: 100%;
            position: absolute;
        }

        .ellipse {
            position: absolute;
            height: 100%;
            top: 50%;
            left: 50%;
            border-radius: 100%;
            border: .01rem solid var(--secondary-color);
            transform-origin: center;
        }

        .ellipse:nth-child(1) {
            width: 80%;
            transform: translate(-50%, -50%) rotate(20deg);
        }

        .ellipse:nth-child(2) {
            width: 70%;
            transform: translate(-50%, -50%) rotate(10deg);
        }

        .ellipse:nth-child(3) {
            width: 60%;
            transform: translate(-50%, -50%) rotate(0deg);
        }

        .forground-elements {
            width: 50%;
            height: 50%;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 2rem;
        }



        .review-box {
            width: 50%;
            height: 50%;
            background: var(--primary-color);
            border-radius: .3rem;
            padding: 1rem;
        }

        .reviewer-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .reviewer-img {
            width: 4rem;
        }

        .reviewer-rating {
            display: flex;
            align-items: center;
            gap: .2rem;
        }

        .reviewer-rating i {
            font-size: .7rem;
            color: var(--secondary-color);
        }

        .review-body {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-top: 1rem;
        }

        .review-body i {
            color: var(--secondary-color);
        }

        .review {
            font-size: .75rem;
            opacity: 0.75;
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

        .menu-item .menu-item-image img {
            width: 20%;
            /* Ajustement de la taille de l'image */
            height: 20%;
            display: inline-block;
            transition: transform 0.3s ease;
        }

        .plat-image {
            width: 80px;
            /* Taille réduite de l'image */
            height: auto;
            /* Hauteur ajustée automatiquement */
            display: inline-block;
            transition: transform 0.3s ease;
        }

        .widget-menu-tab {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .widget-menu-tab .item-title {
            cursor: pointer;
            margin-right: 10px;
            padding: 5px 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .widget-menu-tab .item-title.active {
            background-color: black;
            color: white;
        }

        .badge-success {
            background-color: green;
            color: white;
            border: none;
        }

        header {
            background-image: url('{{ asset('assets/images/hero.jpg') }}');
            /* Utilisation de l'helper asset pour générer le bon chemin */
            background-size: cover;
            /* Pour couvrir toute la section */
            background-position: center;
            /* Pour centrer l'image */
            background-repeat: no-repeat;
            /* Pour éviter la répétition de l'image */
            height: 88vh;
            /* Ajustez la hauteur selon vos besoins */
        }

        .foreground-elements {
            width: 50%;
            height: 50%;
            position: absolute;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 2rem;
        }

        .hero-img {
            width: 30%;
            position: relative;
            top: 50%;
            left: 90%;
            transform: translate(-50%, -50%);
            /* Centre les images */
        }

        .hero-img:nth-child(1) {
            transform: translate(-50%, -50%) rotate(0deg) translateY(-200px);
            /* Ajustez la position et l'angle pour la première image */
        }

        .hero-img:nth-child(2) {
            transform: translate(-50%, -50%) rotate(120deg) translateY(150px);
            /* Ajustez la position et l'angle pour la deuxième image */
        }

        .hero-img:nth-child(3) {
            transform: translate(-50%, -50%) rotate(240deg) translateY(150px);
            /* Ajustez la position et l'angle pour la troisième image */
        }

        @keyframes rotateImages {
            0% {
                transform: translate(-50%, -50%) rotate(0deg);
            }

            100% {
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }
    </style>
</head>

<body>

    <header>
        <!-- Navbar -->
        <nav class="navbar">
            <!-- Logo -->
            <a href="{{ route('webmaster-resto') }}">
                <h3>Web Master Resto <i class="fa-solid fa-utensils"></i></h3>
            </a>

            <!-- Links -->
            <ul class="links-container">
                <li class="link-items"><a href="#" class="links">Menu</a></li>
                <li class="link-items"><a href="#" class="links">Order</a></li>
                <li class="link-items"><a href="#" class="links">Restaurants</a></li>
                <li class="link-items"><a href="#" class="links">Track Order</a></li>
            </ul>

            <!-- Search and Cart -->
            <div class="nav-extras">
                <div class="search">
                    <input style="border: 1px solid rgb(93, 93, 93); border-radius: 20px;" type="text"
                        class="search-box" placeholder="Search Restaurants, Cuisine..... ">
                    <button class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
                <a href="#" class="cart"><i class="fa-solid fa-cart-shopping"></i></a>
            </div>
        </nav>

        <!-- Hero Section -->
        <main id="hero-section">
            <!-- Hero Content -->
            <div class="hero-content">
                <h1 class="hero-heading">Commandez le meilleur</h1>
                <p class="hero-line"><strong>Passez votre commande directement au restaurant de votre choix</strong></p>

                <div class="search location">
                    <input style="border: 1px solid rgb(93, 93, 93); border-radius: 20px;" type="text"
                        class="search-box" placeholder="Search Restaurants, Cuisine..... ">
                    <button class="search-btn locate-btn"><i class="fa-solid fa-location-crosshairs"></i></button>
                </div>

                <div class="hero-action-btn-container">
                    <button class="btn">Commander</button>
                    <p class="or">Ou</p>
                    <button class="btn transparent">Prendre Rendez Vous</button>
                </div>
            </div>

            <!-- Hero Image Container -->
            <div class="foreground-elements">
                <img src="{{ asset('assets/images/spaghetti.png') }}" class="hero-img" alt="">
                <img src="{{ asset('assets/images/poulet.png') }}" class="hero-img" alt="">
                <img src="{{ asset('assets/images/grillade.png') }}" class="hero-img" alt="">
            </div>
            <img src="{{ asset('assets/images/chef.png') }}" alt="">



        </main>
    </header>
    <div class="container">
        <h1 class="text-left my-4" style="text-decoration: underline">Commander auprès de </h1>
        <div class="row">
            @foreach ($restaurants as $restaurant)
                @php
                    $now = \Carbon\Carbon::now();
                    $openingTime = $restaurant->opening_time ? \Carbon\Carbon::createFromTimeString($restaurant->opening_time) : null;
                    $closingTime = $restaurant->closing_time ? \Carbon\Carbon::createFromTimeString($restaurant->closing_time) : null;
                    $isOpen = $openingTime && $closingTime && $now->between($openingTime, $closingTime);
                @endphp
                <div class="col-md-4">
                    <div class="card restaurant-box">
                        <div class="position-relative">
                            <img src="{{ asset('assets/images/blog/professional.jpg') }}" class="card-img-top" alt="{{ $restaurant->name }}">
                            <span class="badge position-absolute top-0 end-0"
                                  style="height: 14%; width: 28%; background-color: {{ $isOpen ? '#0F8A21' : '#D51E20' }}; color: white;">
                             <strong style="font-family: Helvetica, sans-serif; text-align:center; font-size: 15px;"> {{ $isOpen ? 'Ouvert' : 'Fermé' }} </strong>
                            </span>
                        </div>
                        <div class="card-body d-flex flex-column align-items-center">
                            <h4 class="card-title text-center">{{ $restaurant->name }}</h4>
                            <p class="card-text text-center">{{ $restaurant->description }}</p>
                            <a href="{{ route('restaurant.showById', ['id' => $restaurant->id]) }}" class="btn btn-warning mt-auto">
                                <span style="font-family: Helvetica, sans-serif; text-align:center">
                                    Voir le menu
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>


    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0 border-0">
                <h3 class="h-title">Commande rapide</h3>
            </div>
            <div class="card-body border-0 pb-0">
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        @foreach($menus as $menu)
                            @foreach($menu->plats as $plat)
                                <div class="swiper-slide">
                                    <div class="card">
                                        <div class="card-body selling-menu pt-0 px-0 pb-0">
                                            <div class="card-media">
                                                <img src="{{ asset('assets/images/menu/menu1.jpg') }}" alt="">
                                            </div>
                                            <div class="media-data">
                                                <div class="d-flex justify-content-between align-items-baseline">
                                                    <div>
                                                        <h4 class="mb-0">{{ $plat->name }}</h4>
                                                        <span>{{ $plat->description }}</span>
                                                    </div>
                                                    <i style="color: #e11a27" class="fa-solid fa-heart ms-auto c-heart c-pointer"></i>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between my-2 media-data">
                                                <h4>{{ $plat->price }} F</h4>
                                                <ul class="star-rating">
                                                    <li><i style="color: #e1a21a" class="fa fa-star"></i></li>
                                                    <li><i style="color: #e1a21a" class="fa fa-star"></i></li>
                                                    <li><i style="color: #e1a21a"class="fa fa-star"></i></li>
                                                    <li><i style="color: #e1a21a"class="fa-solid fa-star-half-stroke"></i></li>
                                                    <li><i style="color: #e1a21a"class="fa-solid fa-star-half-stroke"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="media-data card-footer order-now">
                                            <div class="d-flex justify-content-between align-items-baseline">
                                                <div>
                                                    @if($plat->menus->first() && $plat->menus->first()->restaurant)
                                                        <span><i class="fa-solid fa-location-dot me-2"></i> {{$plat->menus->first()->restaurant->name}} , {{ $plat->menus->first()->restaurant->address }}</span>
                                                    @else
                                                        <span><i class="fa-solid fa-location-dot me-2"></i>Adresse non disponible</span>
                                                    @endif
                                                    <div>
                                                        <span class="me-1"><i class="fa-solid fa-bicycle me-2"></i>10 Min</span>
                                                        <span class="ms-1"><i class="fas fa-bell me-2"></i>15 Min</span>
                                                    </div>
                                                </div>
                                                <a href="ecom-product-detail.html" class="btn btn-primary btn-sm">Commander</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                    <!-- Add Pagination, Navigation, etc. here -->
                </div>
            </div>





        </div>
    </div>


    <!-- Required vendors -->
    <script src="{{ asset('assets/vendor/global/global.min.js') }}"></script>

    <script src="{{ asset('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/apexchart/apexchart.js') }}"></script>

    <!-- Dashboard 1 -->
    <script src="{{ asset('assets/js/dashboard/analytics.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/js/swiper-bundle.min.js') }}"></script>

    <!-- Vectormap -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/js/deznav-init.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const images = document.querySelectorAll('.hero-img');
            images.forEach((image, index) => {
                image.style.animation = `rotateImages 10s linear ${index * 3}s infinite`;
            });
        });
    </script>
    <!-- Scripts -->
    <script src="app.js"></script>
    <script>
        AOS.init();
    </script>
    <script>
        // AOS CDN
        var aosScript = document.createElement('script');
        aosScript.src = 'https://unpkg.com/aos@2.3.1/dist/aos.js';
        aosScript.onload = function() {
            AOS.init();
        };
        document.head.appendChild(aosScript);

        var faScript = document.createElement('script');
        faScript.src = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js';
        document.head.appendChild(faScript);
    </script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
            spaceBetween: 10,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                // when window width is >= 640px
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20
                },
                // when window width is >= 768px
                768: {
                    slidesPerView: 3,
                    spaceBetween: 30
                },
                // when window width is >= 1024px
                1024: {
                    slidesPerView: 4,
                    spaceBetween: 40
                }
            }
        });
    </script>
</body>

</html>
