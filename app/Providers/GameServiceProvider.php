<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\GameService;

class GameServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        $this->app->bind(GameService::class, function($app){
            return new GameService();
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
