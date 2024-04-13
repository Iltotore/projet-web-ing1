<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactCreate extends Notification {
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(private $subject, private $content) {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage {
        return (new MailMessage())
            ->subject("[HurrShop] Ticket envoyé: " . $this->subject)
            ->lines(array_merge(["Message :"], explode("\n", $this->content)))
            ->from("contact@hurrshop.block");
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array {
        return [
            "subject" => $this->subject,
            "content" => $this->content
        ];
    }
}
