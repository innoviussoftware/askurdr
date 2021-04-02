<?php

namespace App\Providers;

use Firebase\V3\Firebase;
use Illuminate\Support\ServiceProvider;
use Firebase\Factory as FirebaseFactory;

class FirebaseServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Firebase::class, function() {
            return (new FirebaseFactory())
                ->withCredentials(base_path('google-service-account.json'))
                ->withDatabaseUri('https://my-project.firebaseio.com')
                ->create();
        });

        $this->app->alias(Firebase::class, 'firebase');
    }
}