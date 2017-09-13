<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\Update;

class UpdateServiceProvider extends ServiceProvider
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
        //
        $this->app->bind('App\Contracts\UpdateContract', function(){
            return new Update();
        });
    }
}
