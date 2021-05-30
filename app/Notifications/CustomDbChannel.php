<?php

namespace App\Notifications;

use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;

class CustomDbChannel
{
    public function send($notifiable, UserNotification $notification)
    {
        $data = $notification->toArray($notifiable);

        return $notifiable->routeNotificationFor('database')->create([
            //customize here
            'notifiable_id' => 1,
            'type' => get_class($notification),
            'data' => $data,
            'read_at' => null,
        ]);
    }
}
