<?php

namespace App\Providers;

use App\Domains\Telegram\Services\BotMenuService;
use App\Domains\Telegram\Services\BotMenuServiceInterface;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\Drivers\Telegram\TelegramDriver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(BotMenuServiceInterface::class, BotMenuService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        DriverManager::loadDriver(TelegramDriver::class);
    }
}
