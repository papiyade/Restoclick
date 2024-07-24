<!-- resources/views/partials/reservation_rows.blade.php -->
@foreach ($commandes as $commande)
    <tr>
        <td>{{ $commande->id }}</td>
        <td>{{ $commande->client_name }}</td>
        <td>
            @php
                $badgeClass = match($commande->statut) {
                    'En Cours' => 'bg-warning',
                    'Terminée' => 'bg-success',
                    'Annulée' => 'bg-danger',
                    default => 'bg-secondary',
                };
            @endphp
            <span class="badge {{ $badgeClass }}">{{ $commande->statut }}</span>
        </td>
        <td>{{ $commande->created_at->format('d/m/Y H:i') }}</td>
        <td>{{ $commande->telephone_client }}</td>
        <td class="py-2">
            <div class="d-flex align-items-center">
                <a class="dropdown-item view-order-details" href="javascript:void(0);" data-order-id="{{ $commande->id }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" style="color: rgb(9, 100, 185);" class="bi bi-eye-fill" viewBox="0 0 16 16">
                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                    </svg>
                </a>
                <a class="dropdown-item text-danger ms-2" href="javascript:void(0);">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                    </svg>
                </a>
            </div>
        </td>
    </tr>
@endforeach
