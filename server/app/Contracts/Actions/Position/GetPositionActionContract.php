<?php

namespace App\Contracts\Actions\Position;


use App\Contracts\Services\AbzApiServiceContract;


interface GetPositionActionContract
{
    /**
     * @param AbzApiServiceContract $api_service
     */
    public function __construct(AbzApiServiceContract $api_service);

    /**
     * @return array
     */
    public function __invoke(): array;
}
