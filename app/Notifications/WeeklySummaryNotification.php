<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WeeklySummaryNotification extends Notification
{
    use Queueable;

    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('WeeklySummaryNotification Notice')
            ->line('Notification update regarding your account activity.');
    }
}
