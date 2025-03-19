<?php

namespace App\Http\Controllers;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function show()
    {
        // Récupérer toutes les notifications
        $notifications = Notification::all();

        // Passer les notifications à la vue
        return view('notifHome', compact('notifications'));
    }
}
