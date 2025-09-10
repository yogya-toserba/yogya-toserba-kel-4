<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PelangganResetPasswordNotification extends Notification
{
    use Queueable;

    protected $token;
    protected $expires_in;

    /**
     * Create a new notification instance.
     */
    public function __construct($token, $expires_in = 15)
    {
        $this->token = $token;
        $this->expires_in = $expires_in;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Kode Reset Password - MyYOGYA')
            ->view('emails.password-reset-otp', [
                'user' => $notifiable,
                'otp' => $this->token,
                'expires_in' => $this->expires_in
            ]);
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
        ];
    }
}
