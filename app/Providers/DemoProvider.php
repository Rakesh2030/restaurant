<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Greeting;

class DemoProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        $this->app->bind(Greeting::class,function(){
            return new Greeting();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
