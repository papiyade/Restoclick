<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::orderBy('created_at', 'desc')->paginate(10);
        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->is_read = true;
        $notification->save();

        // Vérifier le type de notification pour rediriger
        if ($notification->type === 'reservation') {
            return redirect()->route('admin.reservations.index');
        } elseif ($notification->type === 'commande') {
            return redirect()->route('admin.commandes.index');
        }

        // Rediriger par défaut à un lien associé à la notification
        return redirect($notification->link);
    }


    public function getUnreadNotifications()
{
    $user = auth()->user();

    // Récupérer les notifications non lues pour le restaurant connecté
    $notifications = Notification::where('is_read', false)
        ->where('restaurant_id', $user->restaurant_id)
        ->orderBy('created_at', 'desc')
        ->get();

    // Retourner les notifications en JSON
    return response()->json($notifications);
}

}
