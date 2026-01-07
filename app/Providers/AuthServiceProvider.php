<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        \Illuminate\Auth\Notifications\VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new \Illuminate\Notifications\Messages\MailMessage)
                ->subject('Verifikasi Alamat Email - RS Livasya')
                ->greeting('Yth. ' . $notifiable->name . ',')
                ->line('Terima kasih telah mendaftar di Portal Karir RS Livasya.')
                ->line('Untuk melanjutkan proses pendaftaran dan rekrutmen, mohon verifikasi alamat email Anda dengan menekan tombol di bawah ini.')
                ->action('Verifikasi Email Saya', $url)
                ->line('Jika Anda tidak merasa membuat akun ini, silakan abaikan pesan ini.')
                ->salutation('Hormat kami, HRD RS Livasya');
        });
    }
}
