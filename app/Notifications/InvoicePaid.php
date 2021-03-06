<?php

namespace App\Notifications;

use App\Mail\SuccessRegistrasi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvoicePaid extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $cart, $total;
    public function __construct($cart, $total)
    {
        $this->cart = $cart;
        $this->total = $total;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
        // return (new SuccessRegistrasi($this->user->id));
    }

    public function toDatabase()
    {
        $current = Carbon::now();
        $current->setlocale('Asia/Jakarta');
        $dt = Carbon::parse($current)->format("d F Y");
        return [
            'tanggal' => $dt,
            'total' => $this->total,
            'cart' => $this->cart
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
