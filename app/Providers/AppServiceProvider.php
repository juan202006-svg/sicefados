<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
<<<<<<< HEAD
use Illuminate\Support\Facades\URL;
=======
use Illuminate\Support\Str;
>>>>>>> 1c56af8e8230f9435857922390b0b0385342dfab

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()

    {
<<<<<<< HEAD
            /*
         if (app()->environment('local')) {
        URL::forceScheme('https');
    }
         */
=======
        // Forzar HTTPS en producción y cuando se use ngrok
        $appUrl = env('APP_URL');
        if (env('APP_ENV') === 'production' || (Str::contains($appUrl, 'ngrok'))) {
            \URL::forceScheme('https');
        }
>>>>>>> 1c56af8e8230f9435857922390b0b0385342dfab
    }
}