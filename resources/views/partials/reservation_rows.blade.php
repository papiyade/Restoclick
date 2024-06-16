@forelse ($reservations as $reservation)
    <tr class="btn-reveal-trigger">
        <td class="py-2">
            <div class="form-check custom-checkbox mx-2">
                <input type="checkbox" class="form-check-input" id="customCheckBox{{ $reservation->id }}">
                <label class="form-check-label" for="customCheckBox{{ $reservation->id }}"></label>
            </div>
        </td>
        <td class="py-2">
            <div class="d-flex align-items-center">
                <div class="avatar-circle">
                    {{ strtoupper(substr($reservation->client_name, 0, 1)) }}
                </div>
                <span class="ms-2">{{ $reservation->client_name }}</span>
            </div>
        </td>
        <td class="py-2">{{ \Carbon\Carbon::parse($reservation->date_time)->format('d/m/Y') }}</td>
        <td class="py-2">{{ \Carbon\Carbon::parse($reservation->date_time)->format('H:i') }}</td>
        <td class="py-2">{{ $reservation->num_people }}</td>
        <td class="py-2">{{ $reservation->client_phone_number }}</td>
        <td class="py-2 text-end">
            @if ($reservation->status === 'En Attente')
                <button class="btn btn-primary btn-sm" onclick="confirmReservation({{ $reservation->id }})">Confirmer</button>
            @else
                <span class="badge bg-success">Confirmée</span>
            @endif
        </td>
    </tr>
@empty
    <tr>
        <td colspan="7" class="text-center py-3">Aucune réservation trouvée.</td>
    </tr>
@endforelse
