<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use App\Observers\BarangObserver;
use App\Models\Barang; // Tambahkan model Barang
use App\Models\Ticket;
use App\Observers\TicketObserver;

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
        Ticket::observe(TicketObserver::class);
        // Daftarkan observer untuk model Barang
        Barang::observe(BarangObserver::class);

        // Validasi Captcha
        Validator::extend('captcha', function ($attribute, $value, $parameters, $validator) {
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => env('RECAPTCHA_SECRET_KEY'),
                'response' => $value,
            ]);

            $response = $response->json();

            return $response['success'];
        });
    }
}
