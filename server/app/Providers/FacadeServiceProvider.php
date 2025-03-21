<?php

namespace App\Providers;

use App\Support\ApiResponseSupport;
use App\Support\HttpRequestSupport;
use App\Traits\Providers\ServiceProviderTrait;
use Illuminate\Support\ServiceProvider;

class FacadeServiceProvider extends ServiceProvider
{
    use ServiceProviderTrait;

    /**
     * Register services.
     */
    public function register(): void
    {
        $this->bindSupport('ApiResponse', ApiResponseSupport::class);
        $this->bindSupport('HttpRequest', HttpRequestSupport::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
