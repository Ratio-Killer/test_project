<?php

namespace App\Providers;


use App\Contracts\Services\AbzApiServiceContract;
use App\Services\AbzApiService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AbzApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AbzApiServiceContract::class,
            fn() => new AbzApiService(config('abz_api.url'), config('abz_api.routes')));
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Log::info('Config in boot:', [config('abz_api')]);
    }
}
