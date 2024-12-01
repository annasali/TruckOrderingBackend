<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewOrderNotification extends Notification
{
    use Queueable;
    private $order;

    /**
     * Create a new notification instance.
     */
    public function __construct($order)
    {
        //
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                ->subject('New Truck Order Received')
                ->line('A new truck order has been placed.')
                ->line('Order ID: ' . $this->order->id)
                ->line('Location: ' . $this->order->location)
                ->action('View Order', url('/admin/orders/' . $this->order->id))
                ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
            'order_id' => $this->order->id,
            'location' => $this->order->location,
            'size' => $this->order->size,
            'weight' => $this->order->weight,
        ];
    }
}
