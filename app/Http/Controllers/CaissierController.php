<?php

namespace App\Http\Controllers;
use App\Models\Commande;
use App\Models\Plat;
use App\Models\DetailCommande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Notification;
use App\Models\Paiement;
use App\Models\Restaurant;
use App\Models\Category;
use App\Models\Table;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Auth;


class CaissierController extends Controller
{
    //
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($user && $user->restaurant_id) {
            $query = $request->input('search');
            $status = $request->input('status');
            $commandeId = $request->input('commande_id');
            $dateCommande = $request->input('date_commande');
            $telephone = $request->input('telephone');

            $commandesQuery = Commande::where('restaurant_id', $user->restaurant_id);

            if ($query) {
                $commandesQuery->where('client_name', 'LIKE', "%{$query}%");
            }

            if ($status) {
                $commandesQuery->where('statut', $status);
            }

            if ($commandeId) {
                $commandesQuery->where('id', $commandeId);
            }

            if ($dateCommande) {
                $commandesQuery->whereDate('created_at', $dateCommande);
            }

            if ($telephone) {
                $commandesQuery->where('telephone_client', 'LIKE', "%{$telephone}%");
            }
                    // Ajout de l'ordre par commande récente
        $commandesQuery->orderBy('created_at', 'desc');

            $commandes = $commandesQuery->paginate(5);

            Log::info("Admin ID: {$user->id}, Restaurant ID: {$user->restaurant_id}, Commandes Count: " . $commandes->total());
        } else {
            $commandes = collect();
            Log::info("Admin non authentifié ou sans restaurant_id.");
        }

        if ($request->ajax()) {
            return response()->json([
                'html' => view('partials.commande_row', compact('commandes'))->render()
            ]);
        }

        return view('caissier.commandes.index', compact('commandes', 'status'));
    }
}
