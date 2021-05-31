<?php

namespace App\Notifications;

use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use App\Review;

class CustomDbChannel
{
    public function send($notifiable, UserNotification $notification)
    {
        $data = $notification->toArray($notifiable);
        if ($notification->type == "response") {
            $review = Review::find($notification->response->review_id);
            $id = $review->user_id;
        } else {
            $transaction = $notification->transaction;
            $id = $transaction->user_id;
        }
        return $notifiable->routeNotificationFor('database')->create([
            //customize here
            'notifiable_id' => $id,
            'type' => get_class($notification),
            'data' => $data,
            'read_at' => null,
        ]);
    }
}
