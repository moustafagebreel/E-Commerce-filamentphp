<?php

namespace App\Notifications;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LowStockNotification extends Notification
{
    use Queueable;

    public Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Low Stock Warning: ' . $this->product->name)
            ->line("Product '{$this->product->name}' stock has dropped.")
            ->action('View Product in Admin', url("/admin/products/{$this->product->id}/edit"))
            ->line('Please restock this item soon.');
    }

    public function toArray($notifiable): array
    {
        return [
            'product_id' => $this->product->id,
            'product_name' => $this->product->name,
            'message' => "Low stock alert for {$this->product->name}",
        ];
    }
}
