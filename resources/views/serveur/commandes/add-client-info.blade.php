<!-- resources/views/serveur/commandes/add-client-info.blade.php -->

@extends('layouts.app_serveur')

<!-- resources/views/serveur/commandes/add-client-info.blade.php -->


@section('content')
<div class="container">
    <h2>Informations client</h2>
    <form action="{{ route('serveur.commandes.confirm') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="client_name">Nom du client</label>
            <input type="text" class="form-control" id="client_name" name="client_name" required>
        </div>
        <div class="form-group">
            <label for="telephone_client">Téléphone du client</label>
            <input type="text" class="form-control" id="telephone_client" name="telephone_client" required>
        </div>
        <div class="form-group">
            <label for="mode_paiement">Mode de paiement</label>
            <select class="form-control" id="mode_paiement" name="mode_paiement" required>
                <option value="carte_credit">Carte de crédit</option>
                <option value="wave">Wave</option>
                <option value="om">OM</option>
                <option value="especes">Espèces</option>
            </select>
        </div>
        <div class="form-group">
            <label for="code_pin">Code PIN (si paiement par carte)</label>
            <input type="text" class="form-control" id="code_pin" name="code_pin">
        </div>
        <div class="form-group">
            <label for="mode_commande">Mode de commande</label>
            <select class="form-control" id="mode_commande" name="mode_commande" required>
                <option value="à emporter">À emporter</option>
                <option value="sur place">Sur place</option>
            </select>
        </div>
        <div class="form-group">
            <label for="table_id">Table (si sur place)</label>
            <select class="form-control" id="table_id" name="table_id">
                <!-- Les options seront chargées via JavaScript -->
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Confirmer la commande</button>
    </form>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Chargement des tables disponibles pour le mode sur place
        document.getElementById('mode_commande').addEventListener('change', function () {
            if (this.value === 'sur place') {
                fetch('/serveur/commandes/select-table')
                    .then(response => response.json())
                    .then(data => {
                        let tableSelect = document.getElementById('table_id');
                        tableSelect.innerHTML = '<option value="">Sélectionnez une table</option>';
                        data.tables.forEach(table => {
                            let option = document.createElement('option');
                            option.value = table.id;
                            option.textContent = `Table ${table.number}`;
                            tableSelect.appendChild(option);
                        });
                    });
            } else {
                document.getElementById('table_id').innerHTML = '';
            }
        });
    });
</script>
@endsection
