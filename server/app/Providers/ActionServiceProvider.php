<?php

namespace App\Providers;

use App\Actions\Position\GetPositionAction;
use App\Actions\User\GetUserAction;
use App\Actions\User\GetUsersAction;
use App\Actions\User\UserStoreAction;
use App\Contracts\Actions\Position\GetPositionActionContract;
use App\Contracts\Actions\User\GetUserActionContract;
use App\Contracts\Actions\User\GetUsersActionContract;
use App\Contracts\Actions\User\UserStoreActionContract;
use App\Traits\Providers\ServiceProviderTrait;
use Illuminate\Support\ServiceProvider;

class ActionServiceProvider extends ServiceProvider
{
    use ServiceProviderTrait;

    /**
     * Register services.
     */
    public function register(): void
    {
        $actions = [
            GetUserActionContract::class => GetUserAction::class,
            GetUsersActionContract::class => GetUsersAction::class,
            UserStoreActionContract::class => UserStoreAction::class,
            GetPositionActionContract::class => GetPositionAction::class,
        ];

        foreach ($actions as $contract => $implementation) {
            $this->app->bind($contract, fn() => app()->make($implementation));
        }
    }

}
