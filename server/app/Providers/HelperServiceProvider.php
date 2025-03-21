<?php

namespace App\Providers;

use App\Contracts\Helpers\ApiHelperContract;
use App\Helpers\ApiHelper;
use App\Traits\Providers\ServiceProviderTrait;
use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    use ServiceProviderTrait;

    /**
     * Register services.
     */
    public function register(): void
    {

        $helpers = [
            ApiHelperContract::class => ApiHelper::class
        ];
        foreach ($helpers as $contract => $implementation) {
            $this->app->bind($contract, fn() => $this->makeAction($implementation));
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
