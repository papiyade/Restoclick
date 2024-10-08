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

           /* Définition de l'animation */
    @keyframes moveIcon {
        0% {
            transform: translateX(0);
        }
        50% {
            transform: translateX(30px); /* Déplacement à droite */
        }
        70% {
            transform: translateX(-10px); /* Dépassement léger à gauche */
        }
        100% {
            transform: translateX(0); /* Retour à la position initiale */
        }
    }

    /* Application de l'animation à l'icône */
    .animated-icon {
        animation: moveIcon 4s ease-in-out infinite; /* Animation continue */
    }

        /* Animation pour le fade-in (apparition en fondu) */
        .fade-in {
        animation: fadeIn 1s forwards;
    }

    /* Animation pour le fade-out (disparition en fondu) */
    .fade-out {
        animation: fadeOut 1s forwards;
    }

    /* Animation pour cacher en fondu */
    @keyframes fadeOut {
        from {
            opacity: 1;
        }
        to {
            opacity: 0;
        }
    }

    /* Animation pour faire apparaître en fondu */
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
    </style>

</head>

<body>
    <nav class="navbar " style="background: linear-gradient(45deg, #1a1034, #524b82);">
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
                <!-- Panier -->
                <div class="col-lg-4 order-lg-2 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Votre Panier</span>
                        <span class="badge badge-primary badge-pill" style="background: linear-gradient(45deg, #1a1034, #524b82);">
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
                                    <strong>{{ $item->quantity }}</strong>
                                    <span class="text-muted">{{ $item->price }} Fcfa</span>
                                </div>
                            </li>
                        @endforeach
                        <li class="list-group-item d-flex justify-content-between" style="background-color: #1a1034;">
                            <span style="color: white">Total (Fcfa)</span>
                            <strong style="color: white">{{ $totalPrice }} F</strong>
                        </li>
                    </ul>
                </div>

<!-- Timer centré -->
{{-- <div id="timer-container" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: #524b82; color: white; padding: 40px 20px; border-radius: 20px; text-align: center; width: 300px; height: 300px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);">
    <!-- Icône de plat avec animation -->
    <div style="margin-bottom: 30px;">
        <img src="{{ asset('assets/images/prime-time.png') }}" alt="Icone de plat" class="animated-icon" style="width: 100px; height: 100px;">
    </div>

    <!-- Timer centré en dessous -->
    <div id="timer-text" class="fade-in" style="font-size: 28px; font-weight: bold;">
        Temps restant : <span id="timer">--</span>
    </div>

    <!-- Texte 'Commande prête !' masqué par défaut -->
    <div id="ready-text" class="fade-out" style="font-size: 28px; font-weight: bold; display: none;">
        Commande prête !
    </div>
</div> --}}



                <!-- Formulaire de validation de la commande -->
                <div class="col-lg-8 order-lg-1">
                    <form id="orderForm" method="POST" action="{{ route('commander') }}">
                        @csrf
                        <input type="hidden" name="restaurant_id" value="{{ $restaurantId }}">

                        <!-- Champs pour le nom du client et le numéro de téléphone -->
                        <div class="mb-3">
                            <label for="client_name" class="form-label">Nom Complet</label>
                            <input type="text" style="width: 60%" class="form-control" id="client_name" name="client_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="telephone_client" class="form-label">Numéro de Téléphone</label>
                            <input type="text" style="width: 60%" class="form-control" id="telephone_client" name="telephone_client" required>
                        </div>

                        <!-- Champ caché pour le panier (cart) -->
                        <input type="hidden" name="cart" id="cartData" value="{{ json_encode($cartItems) }}">

                        <!-- Modes de Paiement -->
                        <div class="form-group">
                            <h3>Mode de Paiement</h3>
                            <div class="row">
                                <div class="col-6 col-md-3 text-center mb-3">
                                    <input class="form-check-input" type="radio" id="especes" name="mode_paiement" value="especes" required>
                                    <label class="form-check-label" for="especes">
                                        <img src="{{ asset('assets/images/espèce.png') }}" style="width: 65px;" alt="Espèces">
                                        <br>Espèces
                                    </label>
                                </div>
                                <div class="col-6 col-md-3 text-center mb-3">
                                    <input class="form-check-input" type="radio" id="om" name="mode_paiement" value="om" required>
                                    <label class="form-check-label" for="om">
                                        <img src="{{ asset('assets/images/om.png') }}" style="width: 65px;" alt="Orange Money">
                                        <br>Orange Money
                                    </label>
                                </div>
                                <div class="col-6 col-md-3 text-center mb-3">
                                    <input class="form-check-input" type="radio" id="wave" name="mode_paiement" value="wave" required>
                                    <label class="form-check-label" for="wave">
                                        <img src="{{ asset('assets/images/wave.png') }}" style="width: 120px" alt="Wave">
                                        <br>Wave
                                    </label>
                                </div>
                                <div class="col-6 col-md-3 text-center mb-3">
                                    <input class="form-check-input" type="radio" id="carte_credit" name="mode_paiement" value="carte_credit" required>
                                    <label class="form-check-label" for="carte_credit">
                                        <img src="{{ asset('assets/images/credit_card.png') }}" style="width: 65px;" alt="Carte de Crédit">
                                        <br>Carte de Crédit
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Code Pin -->
                        <div id="code-pin-div" style="display:inline-block; margin-top:2%;" class="row">
                            <label for="code_pin">Code</label>
                            <input class="form-control" style="width: 60%;" type="text" id="code_pin" name="code_pin">
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
                                    @foreach ($tables as $table)
                                        <option value="{{ $table->id }}">{{ $table->numero_table }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <button style="background: linear-gradient(45deg, #1a1034, #524b82);" type="submit" class="btn btn-dark mt-3">Passer la commande</button>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    {{-- <script>
$(document).ready(function() {
    // Fonction pour démarrer le timer
    function startTimer(duration, display) {
        var timer = duration, minutes, seconds;
        var interval = setInterval(function() {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            // Formater les minutes et secondes pour avoir toujours deux chiffres
            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.text(minutes + ":" + seconds); // Afficher le temps restant

            if (--timer < 0) {
                clearInterval(interval); // Arrêter le timer une fois terminé

                // Faire disparaître le texte "Temps restant : ..." avec animation de fondu
                $('#timer-text').fadeOut(2000, function() {
                    // Afficher le texte "Commande prête !" après la disparition du timer
                    $('#ready-text').fadeIn(2000);
                });

                // 5 secondes après que "Commande prête !" soit affiché, cacher le div du timer
                setTimeout(function() {
                    $('#timer-container').fadeOut(1000); // Disparition du div après 5 secondes
                }, 5000);
            }
        }, 1000); // Décompte chaque seconde
    }

    // Gestion du formulaire de commande avec AJAX
    $('#orderForm').submit(function(event) {
        event.preventDefault();
        $.ajax({
            url: '{{ route('commander') }}',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if (response.success) {
                    // Affichage de l'alerte SweetAlert
                    Swal.fire({
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        // Récupérer le temps de préparation dynamique depuis la réponse AJAX
                        var preparationTime = Math.floor((new Date(response.timer_expiration_time).getTime() - new Date().getTime()) / 1000);

                        // Afficher le timer après le succès
                        $('#timer-container').fadeIn(); // Afficher le div du timer
                        startTimer(preparationTime, $('#timer')); // Démarrer le timer avec le temps dynamique
                    });
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
                alert('Erreur lors de la soumission de la commande.');
            }
        });
    });

    // Gestion de la visibilité du champ Code Pin
    $('input[name="mode_paiement"]').change(function() {
        if ($(this).val() == 'om' || $(this).val() == 'wave' || $(this).val() == 'carte_credit') {
            $('#code-pin-div').show();
            $('#code_pin').attr('required', true);
        } else {
            $('#code-pin-div').hide();
            $('#code_pin').removeAttr('required');
        }
    });

    // Gestion de la visibilité de la sélection de table
    $('input[name="mode_commande"]').on('change', function() {
        if ($(this).val() === 'sur place') {
            $('#table-select').show();
        } else {
            $('#table-select').hide();
        }
    });
});

    </script> --}}

    <script>
        $(document).ready(function() {
            // Vérifier s'il y a un message de succès dans la session (affiché après la redirection)
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Commande passée avec succès!',
                    showConfirmButton: false,
                    timer: 1500 // Durée de l'alerte en millisecondes
                }).then(function() {
                    // Redirection après 3 secondes
                    // Dans checkout.blade.php, après le SweetAlert
                    setTimeout(function() {
                        window.location.href =
                            "{{ route('restaurant.showById', ['id' => $restaurant->id]) }}?success=true";
                    }, 3000); // 3000 millisecondes = 3 secondes

                });
            @endif

            // Gestion du formulaire de commande avec AJAX
            $('#orderForm').submit(function(event) {
                event.preventDefault();
                $.ajax({
                    url: '{{ route('commander') }}',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        // Affichage de l'alerte SweetAlert
                        Swal.fire({
                            icon: 'success',
                            title: 'Commande passée avec succès!',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            // Redirection après 3 secondes
                            setTimeout(function() {
                                window.location.href =
                                    "{{ route('restaurant.showById', ['id' => $restaurant->id]) }}?success=true";
                            }, 3000); // 3000 millisecondes = 3 secondes
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        alert('Erreur lors de la soumission de la commande.');
                    }
                });
            });

            // Gestion de la visibilité du champ Code Pin
            $('input[name="mode_paiement"]').change(function() {
                if ($(this).val() == 'om' || $(this).val() == 'wave' || $(this).val() == 'carte_credit') {
                    $('#code-pin-div').show();
                    $('#code_pin').attr('required', true);
                } else {
                    $('#code-pin-div').hide();
                    $('#code_pin').removeAttr('required');
                }
            });

            // Gestion de la visibilité de la sélection de table
            $('input[name="mode_commande"]').on('change', function() {
                if ($(this).val() === 'sur place') {
                    $('#table-select').show();
                } else {
                    $('#table-select').hide();
                }
            });
        });
    </script>



</body>

</html>
