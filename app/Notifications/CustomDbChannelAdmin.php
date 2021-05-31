<?php

namespace App\Notifications;

use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;

class CustomDbChannelAdmin
{
    public function send($notifiable, AdminNotification $notification)
    {
        $data = $notification->toArray($notifiable);

        return $notifiable->routeNotificationFor('database')->create([
            //customize here
            'notifiable_id' => Auth::guard('admin')->user()->id,
            'type' => get_class($notification),
            'data' => $data,
            'read_at' => null,
        ]);
    }
}
