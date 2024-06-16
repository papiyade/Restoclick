<!-- resources/views/partials/reservation_rows.blade.php -->
@forelse ($commandes as $commande)
<tr class="btn-reveal-trigger">
    <td class="py-2">
        <div class="form-check custom-checkbox mx-2">
            <input type="checkbox" class="form-check-input" id="customCheckBox{{ $commande->id }}">
            <label class="form-check-label" for="customCheckBox{{ $commande->id }}"></label>
        </div>
    </td>
    <td class="py-2">
        <div class="d-flex align-items-center">
            <div class="avatar-circle">
                {{ strtoupper(substr($commande->client_name, 0, 1)) }}
            </div>
            <span class="ms-2">{{ $commande->client_name }}</span>
        </div>
    </td>
    <td class="py-2">{{ $commande->statut }}</td>
    <td class="py-2">Créé le </td>
    <td class="py-2">Téléphone</td>
    <td class="py-2">A</td>
    <td class="py-2 text-end">
        <div class="dropdown">
            <button class="btn btn-primary tp-btn-light sharp" type="button" data-bs-toggle="dropdown">
                <span class="fs--1">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"></rect>
                            <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                            <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                            <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                        </g>
                    </svg>
                </span>
            </button>
            <div class="dropdown-menu dropdown-menu-end border py-0">
                <div class="py-2">
                    <a class="dropdown-item" href="javascript:void(0);">Edit</a>
                    <a class="dropdown-item text-danger" href="javascript:void(0);">Delete</a>
                </div>
            </div>
        </div>
    </td>
</tr>
@empty
<tr>
    <td colspan="7" class="text-center">Aucune Commande pour le moment</td>
</tr>
@endforelse
