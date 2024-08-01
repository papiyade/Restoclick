<!DOCTYPE html>
<html lang="en">

<head>
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
    <!-- PAGE TITLE HERE -->
    <title>Salero Restaurant Admin Bootstrap 5 Template</title>
    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    <style>
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
    <div class="container" style="margin-top: 30px;">
        <h2 class="mt-10">Validation de la commande</h2>

        <div class="card-body">
            <div class="row">
                <div class="col-lg-4 order-lg-2 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Votre Panier</span>
                        <span class="badge badge-primary badge-pill" style="background-color: rgb(160, 132, 16)">
                            {{ count($cartItems) }}
                        </span>
                    </h4>
                    <ul class="list-group mb-3">
                        <!-- Titres des colonnes -->
                        <li class="list-group-item d-flex justify-content-between">
                            <div>
                                <strong class="fs-4">Produit</strong>
                            </div>
                            <div class="d-flex flex-column align-items-end">
                                <strong class="fs-4">Quantité</strong>
                                <strong class="fs-6 text-muted">Prix</strong>
                            </div>
                        </li>

                        @foreach ($cartItems as $item)
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0">{{ $item->name }}</h6>
                                    <small class="text-muted">{{ $item->description }}</small>
                                </div>
                                <div class="d-flex flex-column align-items-end">
                                    <strong class="">{{ $item->quantity }}</strong>
                                    <span class="text-muted">{{ $item->price }} Fcfa</span>
                                </div>
                            </li>
                        @endforeach
                        <li class="list-group-item d-flex justify-content-between" style="background-color: rgb(160, 132, 16)">
                            <span style="color: white">Total (Fcfa)</span>
                            <strong style="color: white">{{ $totalPrice }} F</strong>
                        </li>
                    </ul>
                </div>


                <div class="col-lg-8 order-lg-1">
                    <form id="orderForm" method="POST" action="{{ route('commander') }}">
                        @csrf
                        <input type="hidden" name="restaurant_id" value="{{ $restaurantId }}">
                        <!-- Champs pour le nom du client et le numéro de téléphone -->
                        <div class="mb-3">
                            <label for="client_name" class="form-label">Nom Complet</label>
                            <input type="text" style="width: 60%" class="form-control" id="client_name"
                                name="client_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="telephone_client" class="form-label">Numéro de Téléphone</label>
                            <input type="text" style="width: 60%" class="form-control" id="telephone_client"
                                name="telephone_client" required>
                        </div>
                        <!-- Champ caché pour le panier (cart) -->
                        <input type="hidden" name="cart" id="cartData" value="{{ json_encode($cartItems) }}">

                        <div class="form-group">
                            <h3>Mode de Paiement</h3>
                            <div class="d-flex flex-wrap">
                                <div class="form-check form-check-inline text-center mr-4">
                                    <input style="margin-top: 89%" class="form-check-input" type="radio"
                                        id="especes" name="mode_paiement" value="especes" required>
                                    <label class="form-check-label" for="especes">
                                        <img src="{{ asset('assets/images/espèce.png') }}" style="width: 65px;"
                                            class="form-check-img" alt="Espèces">
                                        <br>Espèces
                                    </label>
                                </div>
                                <div class="form-check form-check-inline text-center mr-4">
                                    <input style="margin-top: 60%" class="form-check-input" type="radio"
                                        id="om" name="mode_paiement" value="om" required>
                                    <label class="form-check-label" for="om">
                                        <img src="{{ asset('assets/images/om.png') }}" style="width: 65px;"
                                            class="form-check-img" alt="Orange Money">
                                        <br>Orange Money
                                    </label>
                                </div>
                                <div class="form-check form-check-inline text-center mr-4">
                                    <input style="margin-top: 50%" class="form-check-input" type="radio"
                                        id="wave" name="mode_paiement" value="wave" required>
                                    <label class="form-check-label" for="wave">
                                        <img src="{{ asset('assets/images/wave.png') }}" style="width: 130px;"
                                            class="form-check-img" alt="Wave">
                                        <br>Wave
                                    </label>
                                </div>
                                <div class="form-check form-check-inline text-center mr-4">
                                    <input style="margin-top: 56%" class="form-check-input" type="radio"
                                        id="carte_credit" name="mode_paiement" value="carte_credit" required>
                                    <label class="form-check-label" for="carte_credit">
                                        <img src="{{ asset('assets/images/credit_card.png') }}" style="width: 65px;"
                                            class="form-check-img" alt="Carte de Crédit">
                                        <br>Carte de Crédit
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div id="code-pin-div" style="display:inline-block; margin-top:2%;" class="row">
                            <label for="code_pin">Code</label>
                            <input class="form-control" style="width: 60%;" type="text" id="code_pin"
                                name="code_pin">
                        </div>

                        <div id="code-pin-div" style="display:none;">
                            <label for="code_pin">Code Pin</label>
                            <input class="form-control" style="width: 20%;" type="text" id="code_pin"
                                name="code_pin">
                        </div>

                         <!-- Mode de commande -->
    <div class="form-group">
        <h3>Mode de Commande</h3>
        <div class="d-flex flex-wrap">
            <div class="form-check form-check-inline text-center mr-4">
                <input style="margin-top: 5%" class="form-check-input" type="radio" id="emporter" name="mode_commande" value="à emporter" required>
                <label class="form-check-label" for="emporter">À emporter</label>
            </div>
            <div class="form-check form-check-inline text-center mr-4">
                <input style="margin-top: 5%" class="form-check-input" type="radio" id="sur_place" name="mode_commande" value="sur place" required>
                <label class="form-check-label" for="sur_place">Sur place</label>
            </div>
        </div>
    </div>

    <!-- Sélection de table -->
    <div id="table-select" style="display: none;">
        <div class="form-group">
            <label for="table_id">Table</label>
            <select name="table_id" id="table_id" class="form-control">
                @foreach($tables as $table)
                    <option value="{{ $table->id }}">{{ $table->numero_table }}</option>
                @endforeach
            </select>
        </div>
    </div>

                        <button style="background-color: #000" type="submit" class="btn btn-dark mt-3">Passer la commande</button>
                    </form>
                </div>
                <div class="alert alert-success mt-4" id="success-alert" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Succès!</strong> La commande a été passée avec succès.
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('input[name="mode_commande"]').on('change', function() {
            if ($(this).val() === 'sur place') {
                $('#table-select').show();
            } else {
                $('#table-select').hide();
            }
        });
            $('#commandeForm').submit(function(event) {
                event.preventDefault();
                $.ajax({
                    url: '{{ route('commander') }}',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#success-alert').fadeIn();
                        $('#commandeForm')[0].reset();
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        alert('Erreur lors de la soumission de la commande.');
                    }
                });
            });
        });
    </script>

 <!-- Scripts -->
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
 <script>
     // Vérifier s'il y a un message de succès dans la session (affiché après la redirection)
     @if(session('success'))
         Swal.fire({
             icon: 'success',
             title: 'Commande passée avec succès!',
             showConfirmButton: false,
             timer: 1500  // Durée de l'alerte en millisecondes
         }).then(function () {
             // Redirection vers la page wemaster-resto.blade.php après l'alerte
             window.location.href = "{{ route('webmaster-resto') }}";
         });
     @endif
 </script>
    <script>
        $(document).ready(function() {
            $('input[name="mode_paiement"]').change(function() {
                if ($(this).val() == 'om' || $(this).val() == 'wave' || $(this).val() == 'carte_credit') {
                    $('#code-pin-div').show();
                    $('#code_pin').attr('required', true);
                } else {
                    $('#code-pin-div').hide();
                    $('#code_pin').removeAttr('required');
                }
            });
        });
    </script>
</body>

</html>
