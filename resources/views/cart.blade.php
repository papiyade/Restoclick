<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="robots" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Salero:Restaurant Admin Bootstrap 5 Template">
    <meta property="og:title" content="Salero:Restaurant Admin Bootstrap 5 Template">
    <meta property="og:description" content="Salero:Restaurant Admin Bootstrap 5 Template">
    <meta property="og:image" content="page-error-404.html">
    <meta name="format-detection" content="telephone=no">
    <title>Panier</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        .image-container img {
            max-width: 100px;
        }

        .plat-info {
            flex: 1;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
        }

        .custom-navbar {
            background-color: #2d2d2d;
            /* Remplacez par la couleur de votre choix */
        }
    </style>


</head>

<body>

    <nav class="navbar navbar-dark custom-navbar">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <a href="{{ url('restaurant/' . $restaurant->id) }}" class="navbar-brand">
                <h3 style="font-family: Arial; color:#ffffff;">
                    Restolink
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
    <div class="container mt-5">
        <h3> {{ $restaurant->name }}</h3>
        @php $total = 0 @endphp
        @if ($cart)
            @foreach ($cart as $id => $item)
                <div class="row mb-4" rowId="{{ $id }}">
                    <div class="col-12">
                        <div class="card d-flex flex-row align-items-center">
                            <div class="card-body d-flex">
                                <!-- Image du plat -->
                                <div class="image-container mr-4">
                                    <img class="rounded" style="width: 100px; height: auto;"
                                        src="{{ isset($item['image_url']) ? asset('storage/' . $item['image_url']) : 'N/A' }}"
                                        alt="{{ $item['name'] }}">
                                </div>

                                <!-- Informations sur le plat -->
                                <div class="plat-info mr-auto">
                                    <h5 class="card-title">{{ $item['name'] }}</h5>
                                    <p class="card-text">{{ $item['description'] }}</p>
                                    <p class="card-text">{{ $item['price'] }} Fcfa</p>
                                </div>

                                <!-- Contrôles de quantité et prix total -->
                                <div class="quantity-controls text-right ml-3">
                                    <div class="d-flex align-items-center">
                                        <div class="quantity-buttons d-flex align-items-center bg-light p-1 rounded">
                                            <button class="btn decrease-quantity"
                                                style="border: none; color: black; font-size: 14px; padding: 0.5rem;">-</button>
                                            <span class="mx-2" style="font-size: 14px;">{{ $item['quantity'] }}</span>
                                            <button class="btn increase-quantity"
                                                style="border: none; color: black; font-size: 14px; padding: 0.5rem;">+</button>
                                        </div>
                                        <a class="delete-item ml-3" href="javascript:void(0);">
                                            <svg style="color: black; font-size:24rem;" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                                            </svg>
                                        </a>
                                    </div>

                                </div>


                            </div>
                            <p class="card-text badge badge-rounded badge-outline-dark mt-3">
                                {{ $item['price'] * $item['quantity'] }} Fcfa
                            </p>
                        </div>
                    </div>
                </div>
                <hr>
                @php $total += $item['price'] * $item['quantity'] @endphp
            @endforeach
        @else
            <div class="row">
                <div class="col-12">
                    <p class="text-center">Votre panier est vide.
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-cart-x-fill" viewBox="0 0 16 16">
                            <path
                                d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0M7.354 5.646 8.5 6.793l1.146-1.147a.5.5 0 0 1 .708.708L9.207 7.5l1.147 1.146a.5.5 0 0 1-.708.708L8.5 8.207 7.354 9.354a.5.5 0 1 1-.708-.708L7.793 7.5 6.646 6.354a.5.5 0 1 1 .708-.708" />
                        </svg>
                    </p>
                </div>
            </div>
        @endif

        @if ($cart)
            <div class="row">
                <div class="col-12 text-right">
                    <a href="{{ url('/restaurant/' . $restaurantId) }}" class="btn btn-warning">
                        <i class="fa fa-angle-left"></i> Continuer vos achats
                    </a>
                    <a href="{{ route('checkout', ['restaurant_id' => $restaurant->id]) }}" class="btn btn-dark"
                        style="background-color: #000">
                        Valider la commande
                    </a>
                </div>
            </div>
        @endif
    </div>


    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script type="text/javascript">
        $(".delete-item").click(function(e) {
            e.preventDefault();

            var ele = $(this);
            var rowId = ele.parents(".row").attr("rowId");

            Swal.fire({
                title: 'Êtes-vous sûr?',
                text: "Vous ne pourrez pas revenir en arrière après cette action!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, supprimer!',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    // L'utilisateur a confirmé la suppression
                    $.ajax({
                        url: '{{ route('delete.cart.item') }}',
                        method: "DELETE",
                        data: {
                            _token: '{{ csrf_token() }}',
                            plat_id: rowId,
                            restaurant_id: {{ $restaurantId }}
                        },
                        success: function(response) {
                            window.location.reload(); // Recharge la page après la suppression
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }
            });
        });


        $(".increase-quantity").click(function(e) {
            e.preventDefault();

            var ele = $(this);
            var id = ele.parents(".row").attr("rowId");

            $.ajax({
                url: '{{ route('update.cart.quantity') }}',
                method: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    quantity: 1,
                    restaurant_id: {{ $restaurantId }}
                },
                success: function(response) {
                    window.location.reload();
                }
            });
        });

        $(".decrease-quantity").click(function(e) {
            e.preventDefault();

            var ele = $(this);
            var id = ele.parents(".row").attr("rowId");

            $.ajax({
                url: '{{ route('update.cart.quantity') }}',
                method: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    quantity: -1,
                    restaurant_id: {{ $restaurantId }}
                },
                success: function(response) {
                    window.location.reload();
                }
            });
        });
    </script>

</body>

</html>
