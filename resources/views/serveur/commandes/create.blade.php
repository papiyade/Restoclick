@extends('layouts.app_serveur')

@section('styles')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        /* Titres et flèches d'étape */
        .step-titles {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }

        .step-title-item {
            display: flex;
            align-items: center;
            font-weight: bold;
            color: #007bff;
            position: relative;
            transition: color 0.3s, transform 0.3s;
        }

        .step-title-item.active {
            color: #007bff;
        }

        .step-title-item .arrow {
            margin: 0 15px;
            color: #b3e5fc;
            font-size: 1.5rem;
        }

        .step-title-item.active .arrow {
            color: #007bff;
        }

        /* Titre des catégories de plats */
        .category-title {
            color: #007bff;
            font-weight: bold;
            margin-top: 20px;
            font-size: 1.25rem;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }

        /* Carte de plat */
        .plat-box {
            border: 1px solid #ddd;
            border-radius: 12px;
            transition: transform 0.2s, box-shadow 0.2s;
            overflow: hidden;
            margin-bottom: 20px;
        }

        /* Effet au survol de la carte de plat */
        .plat-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        /* Informations du plat */
        .plat-info {
            flex-grow: 1;
            margin-left: 15px;
            display: flex;
            flex-direction: column;
        }

        /* Nom du plat */
        .plat-info h6 {
            margin: 0;
            font-size: 1.1rem;
            font-weight: bold;
        }

        /* Image du plat */
        .card-body img {
            border-radius: 8px;
            border: 2px solid #ddd;
        }

        /* Champ de quantité */
        .quantity-input {
            width: 60px;
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #007bff;
            margin-top: 10px;
        }

        /* Boutons */
        .btn {
            border-radius: 5px;
            padding: 10px 15px;
            font-size: 1rem;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }


        .step {
            display: none;
            position: absolute;
            width: 100%;
            transition: opacity 0.5s ease-in-out, transform 0.5s ease-in-out;
        }

        .step.active {
            display: block;
            opacity: 1;
            transform: translateX(0);
        }

        .step.prev {
            opacity: 0;
            transform: translateX(-100%);
        }

        .step.next {
            opacity: 0;
            transform: translateX(100%);
        }

        .step-wrapper {
            position: relative;
            overflow: hidden;
        }

        .step-title {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .step-title .step-number {
            width: 30px;
            height: 30px;
            border: 2px solid #b3e5fc;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #007bff;
            margin-right: 10px;
            font-weight: bold;
        }

        .step-title h3 {
            margin: 0;
            color: #007bff;
        }

        .table-selection .table-box {
            display: inline-block;
            padding: 10px;
            border: 2px solid #ccc;
            border-radius: 5px;
            margin: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .table-selection .table-box:hover {
            background-color: #d6eaff;
            /* Bleu clair au survol */
        }

        .table-selection .table-box input[type="radio"]:checked+label {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }

        .table-box:hover {
            border: 2px solid #007bff;
            background-color: #f1f1f1;
        }


        .menu-item {
            margin-bottom: 10px;
        }

        .button-group {
            position: absolute;
            bottom: 20px;
            right: 20px;
        }

        .button-group button {
            margin-left: 10px;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Étape 1: Indicateur de progression -->
        <div class="step-titles">
            <div class="step-title-item active">
                <span>Sélection de table</span>
                <span class="arrow">→</span>
            </div>
            <div class="step-title-item">
                <span>Choix des plats</span>
                <span class="arrow">→</span>
            </div>
            <div class="step-title-item">
                <span>Infos du Client</span>
            </div>
        </div>



        <h2>Créer une commande</h2>
        <form id="order-form" method="POST" action="{{ route('serveur.commandes.store') }}">
            @csrf
            <!-- Champ caché pour l'ID du restaurant -->
            <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
            <!-- Step 1: Sélection de la table -->
            <div class="step step-1">
                <h4>Sélectionnez une table</h4>
                <div class="table-selection row">
                    @foreach ($tables as $table)
                        <div class="col-md-3">
                            <div class="table-box" onclick="selectTable({{ $table->id }})"
                                id="table_box_{{ $table->id }}"
                                style="cursor: pointer; border: 2px solid transparent; padding: 15px; text-align: center; border-radius: 10px;">
                                <input type="radio" name="table_id" value="{{ $table->id }}"
                                    id="table_{{ $table->id }}" hidden>
                                <i style="font-size: 14px" class="table-icon fas fa-utensils"></i> <!-- Icône de table -->

                                <label for="table_{{ $table->id }}">
                                    Table {{ $table->numero_table }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button type="button" class="btn btn-primary mt-3" onclick="nextStep(2)">Suivant <i
                        class="fa fa-arrow-right" aria-hidden="true"></i></button>
            </div>

            <!-- Step 2: Sélection des plats -->
            <!-- Step 2: Sélection des plats -->
            <div class="step step-2" style="display: none;">
                <h4>Sélectionnez les plats</h4>
                <div class="menu-selection">
                    @foreach ($categories as $category)
                        <h5 class="category-title">{{ $category->name }}</h5>
                        <div class="row">
                            @foreach ($plats->where('category_id', $category->id) as $plat)
                                <div class="col-md-4">
                                    <div class="plat-box card mb-3">
                                        <div class="card-body d-flex align-items-center">
                                            <input type="checkbox" name="plats[]" value="{{ $plat->id }}"
                                                onchange="updateQuantityInput({{ $plat->id }})"
                                                class="form-check-input">


                                            <div class="plat-info ml-3">
                                                <h6 style="margin-left: 8px;">{{ $plat->name }}</h6>
                                                <input style="margin-left: 4px" type="number"
                                                    class="form-control mt-2 quantity-input"
                                                    name="quantite[{{ $plat->id }}]" placeholder="Quantité"
                                                    min="1" style="display:inline-block;">
                                            </div>
                                            <img src="{{ asset('storage/' . $plat->image_url) }}"
                                                alt="{{ $plat->name }}"
                                                style="width: 70px; height: 70px; border-radius: 3px; margin-left: 8px;">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
                <button type="button" class="btn btn-secondary mt-3" onclick="prevStep(1)"> <i class="fa fa-arrow-left"
                        aria-hidden="true"> Retour</i></button>
                <button type="button" class="btn btn-primary mt-3" onclick="nextStep(3)">Suivant <i
                        class="fa fa-arrow-right" aria-hidden="true"></i></button>
            </div>



            <!-- Step 3: Informations de la commande -->
            <div class="step step-3" style="display: none;">
                <h4>Informations de la commande</h4>
                <div class="form-group">
                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                    <label for="client_name">Nom du client</label>
                    <input type="text" class="form-control" id="client_name" name="client_name" required>
                </div>

                <div class="form-group">
                    <i class="fa fa-phone" aria-hidden="true"></i>
                    <label for="telephone_client">Numéro de téléphone</label>
                    <input type="text" class="form-control" id="telephone_client" name="telephone_client" required>
                </div>

                <div class="form-group">
                    <i class="fa fa-credit-card" aria-hidden="true"></i>
                    <label for="mode_paiement">Mode de paiement</label>
                    <select class="form-control" id="mode_paiement" name="mode_paiement" required>
                        <option value="carte_credit">Carte de Crédit</option>
                        <option value="om">Orange Money</option>
                        <option value="wave">Wave</option>
                        <option value="especes">Espèces</option>
                    </select>
                </div>
                <div class="form-group" id="code-pin-group" style="display: none;">
                    <label for="code_pin">Code PIN (Carte de Crédit, Orange Money, Wave)</label>
                    <input type="text" class="form-control" id="code_pin" name="code_pin">
                </div>


                <div class="form-group">
                    <i class="fa fa-first-order" aria-hidden="true"></i>
                    <label for="mode_commande">Mode de commande</label>
                    <select class="form-control" id="mode_commande" name="mode_commande" required>
                        <option value="à emporter">À emporter</option>
                        <option value="sur place">Sur place</option>
                    </select>
                </div>

                <button type="button" class="btn btn-secondary mt-3" onclick="prevStep(2)"> <i class="fa fa-arrow-left"
                        aria-hidden="true"> Retour</i> </button>
                <button type="submit" class="btn btn-success mt-3"> <i class="fa fa-check" aria-hidden="true"></i>
                    Valider la commande</button>
            </div>


        </form>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function selectTable(tableId) {
            document.querySelectorAll('.table-box').forEach(box => {
                box.style.border = '2px solid transparent';
            });
            document.getElementById('table_box_' + tableId).style.border = '2px solid #007bff';
            document.getElementById('table_' + tableId).checked = true;
        }


        function updateQuantityInput(platId) {
            const quantityInput = document.querySelector('input[name="quantite[' + platId + ']"]');
            const isChecked = document.querySelector('input[name="plats[]"][value="' + platId + '"]').checked;
            quantityInput.style.display = isChecked ? 'block' : 'none';
        }

        document.getElementById('mode_paiement').addEventListener('change', function() {
            var codePinGroup = document.getElementById('code-pin-group');
            if (this.value !== 'especes') {
                codePinGroup.style.display = 'block';
            } else {
                codePinGroup.style.display = 'none';
            }
        });



        function nextStep(step) {
            if (step === 2) {
                // Avant de passer à l'étape suivante, vérifiez si une table est sélectionnée
                const selectedTable = document.querySelector('input[name="table_id"]:checked');
                if (!selectedTable) {
                    // Utilisez SweetAlert pour afficher une alerte personnalisée
                    Swal.fire({
                        icon: 'warning',
                        title: 'Aucune table sélectionnée',
                        text: 'Veuillez sélectionner une table avant de continuer.',
                        background: '#f0f0f0',
                        confirmButtonText: 'OK'
                    });
                    return;
                }
            }
            // Mise à jour des étapes du formulaire
            document.querySelectorAll('.step').forEach(el => el.style.display = 'none');
            document.querySelector('.step-' + step).style.display = 'block';

            // Mise à jour des titres d'étape
            updateStepTitles(step);
        }

        function prevStep(step) {
            nextStep(step);
        }

        function updateStepTitles(step) {
            document.querySelectorAll('.step-title-item').forEach((el, index) => {
                if (index < step - 1) {
                    el.classList.remove('active');
                } else if (index === step - 1) {
                    el.classList.add('active');
                } else {
                    el.classList.remove('active');
                }
            });
        }

        // Initialisation
        document.addEventListener('DOMContentLoaded', function() {
            updateStepTitles(1);
        });
    </script>
@endsection
