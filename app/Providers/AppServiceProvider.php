<?php

namespace App\Providers;

use Fouladgar\OTP\Notifications\Messages\OTPMessage;
use Fouladgar\OTP\Notifications\OTPNotification;
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
        //
        OTPNotification::toSMSUsing(fn($notifiable, $token) =>(new OTPMessage())
            ->to($notifiable->mobile)
            ->content($token));
    }
}
