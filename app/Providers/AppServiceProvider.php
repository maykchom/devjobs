<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
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
        //Personalizar el correo que se enviará
        VerifyEmail::toMailUsing(function($notifiable, $url){
            return (New MailMessage)
            ->subject('Verificar cuenta')
            ->line('Tu cuenta ya esta casi lista, solo debes presionar el botón de abajo.')
            ->action('Confirmar cuenta', $url)
            ->line('Si no creaste esta cuenta, puedes ignorar este mensaje');
        });
    }
}
