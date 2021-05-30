<?php

namespace App\Notifications;

use App\Response;
use App\Review;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Transaction;
use Illuminate\Support\Facades\Auth;

class UserNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Transaction $transaction, Response $response = null, $type)
    {
        $this->transaction = $transaction;
        $this->type = $type;
        $this->response = $response;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [CustomDbChannel::class]; //<-- important custom Channel defined here
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        if ($this->type == "response") {
            $message = $this->response->content;
            $status = null;
            $response_id = $this->response->id;
            $transaction_id = null;
        } else {
            if ($this->transaction->status == "verified") {
                $message = "Transaksi anda sudah diverifikasi oleh admin !";
            } else if ($this->transaction->status == "canceled") {
                $message = "Transaksi anda telah dibatalkan oleh admin !";
            } else {
                $message = "Barang-barangmu sudah dikirim ! Sabar yaa";
            }
            $status = $this->transaction->status;
            $response_id = null;
            $transaction_id = $this->transaction->id;
        }
        return [
            'transaction_id' => $transaction_id,
            'response_id' => $response_id,
            'type' => $this->type,
            'status' => $status,
            'message' => $message,
            'admin_id' => Auth::user()->id,
        ];
    }
}
