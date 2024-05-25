<?php
// namespace App\Http\Controllers;

// use App\Models\Reservation;
// use App\Models\Restaurant;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Log;

// class ReservationController extends Controller
// {
//     public function index()
//     {
//         $admin = auth()->user();

//         if ($admin && $admin->restaurant_id) {
//             $reservations = Reservation::where('restaurant_id', $admin->restaurant_id)->get();
//             Log::info("Admin ID: {$admin->id}, Restaurant ID: {$admin->restaurant_id}, Reservations Count: " . $reservations->count());
//         } else {
//             $reservations = collect(); // Aucun résultat
//             Log::info("Admin non authentifié ou sans restaurant_id.");
//         }

//         return view('admin.reservation.index', compact('reservations'));
//     }

//     public function showReservationForm($id)
//     {
//         $restaurant = Restaurant::findOrFail($id);
//         return view('book-table', compact('restaurant'));
//     }

//     public function showReservations()
//     {
//         $admin = auth()->user();

//         if ($admin && $admin->restaurant_id) {
//             $reservations = Reservation::where('restaurant_id', $admin->restaurant_id)->get();
//             Log::info("Admin ID: {$admin->id}, Restaurant ID: {$admin->restaurant_id}, Reservations Count: " . $reservations->count());
//         } else {
//             $reservations = collect();
//             Log::info("Admin non authentifié ou sans restaurant_id.");
//         }

//         return view('admin.reservations', compact('reservations'));
//     }

//     public function makeReservation(Request $request)
//     {
//         $request->validate([
//             'name' => 'required|string|max:255',
//             'phone_number' => 'required|string|max:255',
//             'date' => 'required|date',
//             'time' => 'required',
//             'num_people' => 'required|integer',
//             'restaurant_id' => 'required|exists:restaurants,id',
//         ]);

//         $reservation = new Reservation();
//         $reservation->client_name = $request->name;
//         $reservation->client_phone_number = $request->phone_number;
//         $reservation->date_time = $request->date . ' ' . $request->time;
//         $reservation->num_people = $request->num_people;
//         $reservation->restaurant_id = $request->restaurant_id;
//         $reservation->save();

//         return redirect()->route('client.book-table', ['id' => $request->restaurant_id])->with('success', 'Réservation effectuée avec succès!');
//     }
// }
namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReservationController extends Controller
{
    // public function index()
    // {
    //     $admin = auth()->user();

    //     if ($admin && $admin->restaurant_id) {
    //         $reservations = $admin->restaurantReservations;
    //         Log::info("Admin ID: {$admin->id}, Restaurant ID: {$admin->restaurant_id}, Reservations Count: " . $reservations->count());
    //     } else {
    //         $reservations = collect(); // Aucun résultat
    //         Log::info("Admin non authentifié ou sans restaurant_id.");
    //     }

    //     return view('admin.reservation.index', compact('reservations'));
    // }
    public function index()
    {
        $admin = auth()->user();

        if ($admin && $admin->restaurant_id) {
            $reservations = $admin->restaurantReservations;
            Log::info("Admin ID: {$admin->id}, Restaurant ID: {$admin->restaurant_id}, Reservations Count: " . $reservations->count());
        } else {
            $reservations = collect(); // Aucun résultat
            Log::info("Admin non authentifié ou sans restaurant_id.");
        }

        return view('admin.reservation.index', compact('reservations'));
    }

    public function showReservationForm($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        return view('book-table', compact('restaurant'));
    }

    public function showReservations()
    {
        $admin = auth()->user();

        if ($admin && $admin->restaurant_id) {
            $reservations = $admin->restaurantReservations;
            Log::info("Admin ID: {$admin->id}, Restaurant ID: {$admin->restaurant_id}, Reservations Count: " . $reservations->count());
        } else {
            $reservations = collect();
            Log::info("Admin non authentifié ou sans restaurant_id.");
        }

        return view('admin.reservations', compact('reservations'));
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

        return redirect()->route('client.book-table', ['id' => $request->restaurant_id])->with('success', 'Réservation effectuée avec succès!');
    }
}
