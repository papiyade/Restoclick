<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Restaurant;
use App\Models\Table;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationConfirmed;
use Twilio\Rest\Client;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $admin = auth()->user();

        if ($admin && $admin->restaurant_id) {
            $query = $request->input('search');
            $status = $request->input('status', 'Confirmée');

            $reservationsQuery = Reservation::where('restaurant_id', $admin->restaurant_id)
                ->where('status', $status);

            if ($query) {
                $reservationsQuery->where('client_name', 'LIKE', "%{$query}%");
            }

            $reservations = $reservationsQuery->paginate(5);

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

        return view('admin.reservation.index', compact('reservations', 'status'));
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
            'email' => 'required|email|max:255',
            'date' => 'required|date',
            'time' => 'required',
            'num_people' => 'required|integer|min:1|max:30',
            'restaurant_id' => 'required|exists:restaurants,id',
            'table_id' => 'required|exists:tables,id',
        ]);

        $reservation = new Reservation();
        $reservation->client_name = $request->name;
        $reservation->client_phone_number = $request->phone_number;
        $reservation->client_email = $request->email;
        $reservation->date_time = $request->date . ' ' . $request->time;
        $reservation->num_people = $request->num_people;
        $reservation->restaurant_id = $request->restaurant_id;
        $reservation->table_id = $request->table_id;
        $reservation->save();

        // Ajouter une notification pour l'admin du restaurant
        Notification::create([
            'client_name' => $request->name,
            'client_phone_number' => $request->phone_number,
            'date_time' => $request->date . ' ' . $request->time,
            'num_people' => $request->num_people,
            'client_email' => $request->email,
            'message' => "Client {$request->name} vient de faire une réservation.",
            'link' => route('admin.reservations'),
            'restaurant_id' => $request->restaurant_id,
        ]);

        return response()->json(['success' => 'Réservation effectuée avec succès! Vous serez notifié pour la confirmation par E-mail']);
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
            'client_email' => 'required|string|max:255',
            'restaurant_id' => 'required|exists:restaurants,id',
        ]);

        $reservation = new Reservation();
        $reservation->client_name = $request->client_name;
        $reservation->client_phone_number = $request->client_phone_number;
        $reservation->date_time = \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $request->date_time)->format('Y-m-d H:i:s'); // Conversion du format
        $reservation->num_people = $request->num_people;
        $reservation->client_email = $request->client_email;
        $reservation->restaurant_id = $request->restaurant_id;
        $reservation->save();

        return redirect()->route('admin.reservation.index')->with('success', 'Réservation créée avec succès.');
    }

    public function confirm($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->status = 'Confirmée';
        $reservation->save();

        // Send confirmation email
        Mail::to($reservation->client_email)->send(new ReservationConfirmed($reservation));

        return response()->json(['success' => true]);
    }
    public function confirmReservation($id)
    {
        try {
            $reservation = Reservation::findOrFail($id);
            $reservation->status = 'Confirmée';
            $reservation->save();

            // Créer une notification pour l'admin
            Notification::create([
                'reservation_id' => $reservation->id,
                'message' => 'La réservation a été confirmée.',
            ]);

            // Envoyer l'email
            Mail::to($reservation->client_email)->send(new ReservationConfirmed($reservation));

            return response()->json(['success' => 'Réservation confirmée et email envoyé!']);
        } catch (\Exception $e) {
            Log::error('Error confirming reservation: ' . $e->getMessage());
            return response()->json(['error' => 'Erreur lors de la confirmation de la réservation.'], 500);
        }
    }

    public function sendEmail(Request $request)
    {
        $reservation = Reservation::find($request->reservation_id);

        if (!$reservation) {
            return response()->json(['success' => false, 'message' => 'Réservation non trouvée.']);
        }

        // Envoyer l'email
        try {
            Mail::to($reservation->client_email)->send(new ReservationConfirmed($reservation, $request->message));
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Erreur lors de l\'envoi de l\'email.']);
        }

        // Envoyer un message WhatsApp
        try {
            $client = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));

            $client->messages->create(
                'whatsapp:' . $reservation->client_phone_number,
                [
                    'from' => env('TWILIO_WHATSAPP_NUMBER'),
                    'body' => "Bonjour {$reservation->client_name}, votre réservation a été confirmée pour le {$reservation->date_time} pour {$reservation->num_people} personne(s)."
                ]
            );

            return response()->json(['success' => true, 'message' => 'Email et message WhatsApp envoyés avec succès!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Erreur lors de l\'envoi du message WhatsApp: ' . $e->getMessage()]);
        }
    }
}
