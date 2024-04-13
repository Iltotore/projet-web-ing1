<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactReply extends Notification {
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(private $subject, private $replyContent, private $replier) {
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
            ->subject("RE: [HurrShop]" . $this->subject)
            ->lines([$this->replyContent, "", $this->replier . "."])
            ->from("contact@hurrshop.block", $this->replier . " from HurrShop");
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array {
        return [
            "subject" => $this->subject,
            "replyContent" => $this->replyContent,
            "replier" => $this->replier
        ];
    }
}
