<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationComposer
{
    public function compose(View $view)
    {
        $user = Auth::user();

        if ($user) {
            $notifications = Notification::where('is_read', false)
                ->where('restaurant_id', $user->restaurant_id)
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $notifications = collect();
        }

        $view->with('notifications', $notifications);
    }
}
