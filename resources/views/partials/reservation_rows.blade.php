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
    <td style="text-align:center" class="py-2">{{ \Carbon\Carbon::parse($reservation->date_time)->format('d/m/Y') }}</td>
    <td style="text-align:center" class="py-2">{{ \Carbon\Carbon::parse($reservation->date_time)->format('H:i') }}</td>
    <td style="text-align:center" class="py-2">{{ $reservation->num_people }}</td>
    <td style="text-align: center" class="py-2"> {{$reservation->client_email}} </td>
    <td style="text-align:center" class="py-2">{{ $reservation->client_phone_number }}</td>
    <td class="py-2 text-end">
        @if ($reservation->status === 'En Attente')
            <button class="btn btn-primary btn-sm" onclick="confirmReservation({{ $reservation->id }})">Confirmer</button>
            <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#emailModal" onclick="setReservationDetails({{ $reservation->id }}, '{{ $reservation->client_name }}', '{{ $reservation->client_email }}', '{{ \Carbon\Carbon::parse($reservation->date_time)->format('d/m/Y H:i') }}', '{{ $reservation->num_people }}')">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-arrow-up-fill" viewBox="0 0 16 16">
                    <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zm.192 8.159 6.57-4.027L8 9.586l1.239-.757.367.225A4.49 4.49 0 0 0 8 12.5c0 .526.09 1.03.256 1.5H2a2 2 0 0 1-1.808-1.144M16 4.697v4.974A4.5 4.5 0 0 0 12.5 8a4.5 4.5 0 0 0-1.965.45l-.338-.207z"/>
                    <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.354-5.354 1.25 1.25a.5.5 0 0 1-.708.708L13 12.207V14a.5.5 0 0 1-1 0v-1.717l-.28.305a.5.5 0 0 1-.737-.676l1.149-1.25a.5.5 0 0 1 .722-.016"/>
                  </svg>
            </button>
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
