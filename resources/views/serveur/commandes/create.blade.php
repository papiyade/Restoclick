<!-- resources/views/serveur/commandes/create.blade.php -->

@extends('layouts.app_serveur')

<style>
    /* public/css/styles.css */
    .table-box {
        border: 2px solid #007bff;
        border-radius: 8px;
        padding: 10px;
        margin: 10px;
        text-align: center;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .table-box:hover {
        background-color: #007bff;
        color: white;
    }

    .modal-dialog {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modal-content {
        border-radius: 8px;
    }

    /* Optionnel : ajuster le style des colonnes */
    .table-box.col {
        flex: 1;
        max-width: 150px; /* Ajuste selon tes besoins */
    }
</style>

@section('content')
<div class="container">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#selectTableModal">
        Créer une commande
    </button>

    <!-- Modal pour sélectionner une table -->
<!-- Modal pour sélectionner une table -->
<div class="modal fade" id="selectTableModal" tabindex="-1" aria-labelledby="selectTableModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="selectTableModalLabel">Choisissez une table</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="tables-container" class="row">
                    <!-- Tables seront chargées ici via AJAX -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Wizard Steps -->
<div id="wizard-container" class="container" style="display:none;">
    <!-- Step 2: Ajouter des plats -->
    <div id="step-add-dishes" class="wizard-step">
        <h2>Ajouter des plats</h2>
        <div id="plats-container">
            <!-- Les plats seront affichés ici -->
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    fetch('{{ route('serveur.commandes.select-table') }}', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        let tablesContainer = document.getElementById('tables-container');
        tablesContainer.innerHTML = ''; // Vider le conteneur avant d'ajouter de nouvelles tables

        if (data.tables.length === 0) {
            tablesContainer.innerHTML = '<p>Aucune table disponible.</p>';
        } else {
            data.tables.forEach(table => {
                let col = document.createElement('div');
                col.classList.add('col'); // Ajouter la classe col de Bootstrap
                col.classList.add('mb-2'); // Ajouter un espace en bas entre les boxes

                let tableBox = document.createElement('div');
                tableBox.classList.add('table-box');
                tableBox.textContent = ` ${table.numero_table}`;

                // Ajouter l'événement click ici
                tableBox.addEventListener('click', () => {
                    fetch('{{ route('serveur.commandes.store-table-selection') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ tableId: table.id })
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Masquer le modal
                        let selectTableModal = document.getElementById('selectTableModal');
                        let modalBackdrop = document.querySelector('.modal-backdrop');
                        selectTableModal.classList.remove('show');
                        modalBackdrop.remove();

                        // Afficher le wizard pour ajouter des plats
                        document.getElementById('wizard-container').style.display = 'block';
                        loadDishes(table.id);
                    });
                });

                col.appendChild(tableBox);
                tablesContainer.appendChild(col);
            });
        }
    })
    .catch(error => console.error('Error loading tables:', error));
});

function loadDishes(tableId) {
    fetch('/serveur/commandes/add-dishes?table_id=' + tableId, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        let platsContainer = document.getElementById('plats-container');
        platsContainer.innerHTML = ''; // Vider le conteneur avant d'ajouter de nouveaux plats

        if (data.plats.length === 0) {
            platsContainer.innerHTML = '<p>Aucun plat disponible.</p>';
        } else {
            data.plats.forEach(plat => {
                let platCard = document.createElement('div');
                platCard.classList.add('card', 'mb-4');

                let cardBody = document.createElement('div');
                cardBody.classList.add('card-body');
                cardBody.innerHTML = `
                    <h5 class="card-title">${plat.nom}</h5>
                    <p class="card-text">${plat.description}</p>
                    <p class="card-text">Prix : ${plat.prix} CFA</p>
                    <input type="checkbox" name="plats[]" value="${plat.id}"> Ajouter à la commande
                `;

                platCard.appendChild(cardBody);
                platsContainer.appendChild(platCard);
            });
        }
    })
    .catch(error => console.error('Error loading dishes:', error));
}


</script>
@endsection
