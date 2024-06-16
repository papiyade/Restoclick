<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Notification;

class NotificationComposer
{
    public function compose(View $view)
    {
        $notifications = Notification::where('is_read', false)->orderBy('created_at', 'desc')->get();
        $view->with('notifications', $notifications);
    }
}
