<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject("[HurrShop] Vérifiez votre adresse mail")
                ->line("Cliquez sur le bouton ci-dessous pour confirmer votre adresse mail")
                ->action("Valider mon adresse mail", $url);
        });

        ResetPassword::toMailUsing(function (object $notifiable, string $token) {
            return (new MailMessage)
                ->subject("[HurrShop] Réinitialisation du mot de passe")
                ->line("Cliquez sur le bouton ci-dessous pour réinitialiser votre mot de passe")
                ->action("Réinitialiser mon mot de passe", route('password.reset', $token));
        });
    }
}
