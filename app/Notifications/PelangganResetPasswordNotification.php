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
    protected $email;

    /**
     * Create a new notification instance.
     */
    public function __construct($token, $email)
    {
        $this->token = $token;
        $this->email = $email;
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
        $resetUrl = url(route('pelanggan.password.reset', [
            'token' => $this->token,
            'email' => $this->email,
        ], false));

        return (new MailMessage)
            ->subject('Reset Password - Yogya Toserba')
            ->greeting('Halo ' . $notifiable->nama_pelanggan . '!')
            ->line('Anda menerima email ini karena kami menerima permintaan reset password untuk akun Anda.')
            ->line('Kode verifikasi Anda adalah: **' . $this->token . '**')
            ->line('Atau klik tombol di bawah ini untuk reset password:')
            ->action('Reset Password', $resetUrl)
            ->line('Link reset password ini akan berlaku selama 60 menit.')
            ->line('Jika Anda tidak meminta reset password, abaikan email ini.')
            ->salutation('Terima kasih, Tim Yogya Toserba');
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
