<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Restaurant;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $admin = auth()->user();

        if ($admin && $admin->restaurant_id) {
            $query = $request->input('search');

            if ($query) {
                $reservations = Reservation::where('restaurant_id', $admin->restaurant_id)
                                            ->where('client_name', 'LIKE', "%{$query}%")
                                            ->paginate(5);
            } else {
                $reservations = Reservation::where('restaurant_id', $admin->restaurant_id)
                                            ->paginate(5);
            }

            Log::info("Admin ID: {$admin->id}, Restaurant ID: {$admin->restaurant_id}, Reservations Count: " . $reservations->total());
        } else {
            $reservations = collect(); // Aucun résultat
            Log::info("Admin non authentifié ou sans restaurant_id.");
        }

        if ($request->ajax()) {
            return response()->json([
                'html' => view('partials.reservation_rows', compact('reservations'))->render()
            ]);
        }

        return view('admin.reservation.index', compact('reservations'));
    }

    public function showReservationForm($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        return view('book-table', compact('restaurant'));
    }

    // public function showReservations()
    // {
    //     $admin = auth()->user();

    //     if ($admin && $admin->restaurant_id) {
    //         $reservations = $admin->restaurantReservations;
    //         Log::info("Admin ID: {$admin->id}, Restaurant ID: {$admin->restaurant_id}, Reservations Count: " . $reservations->count());
    //     } else {
    //         $reservations = collect();
    //         Log::info("Admin non authentifié ou sans restaurant_id.");
    //     }

    //     return view('admin.reservations', compact('reservations'));
    // }
    public function showReservations()
{
    $admin = auth()->user();

    if ($admin && $admin->restaurant_id) {
        $restaurant = Restaurant::find($admin->restaurant_id);
        $reservations = Reservation::where('restaurant_id', $admin->restaurant_id)->get();
        Log::info("Admin ID: {$admin->id}, Restaurant ID: {$admin->restaurant_id}, Reservations Count: " . $reservations->count());
    } else {
        $restaurant = null; // Aucun restaurant
        $reservations = collect(); // Aucun résultat
        Log::info("Admin non authentifié ou sans restaurant_id.");
    }

    return view('admin.reservations', compact('restaurant', 'reservations'));
}


    public function makeReservation(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required',
            'num_people' => 'required|integer',
            'restaurant_id' => 'required|exists:restaurants,id',
        ]);

        $reservation = new Reservation();
        $reservation->client_name = $request->name;
        $reservation->client_phone_number = $request->phone_number;
        $reservation->date_time = $request->date . ' ' . $request->time;
        $reservation->num_people = $request->num_people;
        $reservation->restaurant_id = $request->restaurant_id;
        $reservation->save();

        // Ajouter une notification
        Notification::create([
            'client_name' => $request->name,
            'client_phone_number' => $request->phone_number,
            'date_time' => $request->date . ' ' . $request->time,
            'num_people' => $request->num_people,
            'message' => "Client {$request->name} vient de faire une réservation.",
            'link' => route('admin.reservations'), // lien vers la page des réservations
        ]);

        return redirect()->route('client.book-table', ['id' => $request->restaurant_id])->with('success', 'Réservation effectuée avec succès!');
    }

    // Nouvelle méthode pour afficher le formulaire de création de réservation
    public function createReservation()
    {
        $admin = auth()->user();

        if ($admin && $admin->restaurant_id) {
            return view('admin.reservation.create', ['restaurant_id' => $admin->restaurant_id]);
        }

        return redirect()->route('admin.reservation.index')->with('error', 'Vous n\'êtes pas autorisé à effectuer cette action.');
    }

    // Nouvelle méthode pour enregistrer la réservation
    public function storeReservation(Request $request)
    {
        $request->validate([
            'client_name' => 'required|string|max:255',
            'client_phone_number' => 'required|string|max:255',
            'date_time' => 'required|date_format:Y-m-d\TH:i', // Changement ici
            'num_people' => 'required|integer',
            'restaurant_id' => 'required|exists:restaurants,id',
        ]);

        $reservation = new Reservation();
        $reservation->client_name = $request->client_name;
        $reservation->client_phone_number = $request->client_phone_number;
        $reservation->date_time = \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $request->date_time)->format('Y-m-d H:i:s'); // Conversion du format
        $reservation->num_people = $request->num_people;
        $reservation->restaurant_id = $request->restaurant_id;
        $reservation->save();

        return redirect()->route('admin.reservation.index')->with('success', 'Réservation créée avec succès.');
    }

    public function confirm($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->status = 'Confirmée';
        $reservation->save();

        return response()->json(['success' => true]);
    }
}
