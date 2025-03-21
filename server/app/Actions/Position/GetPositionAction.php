<?php

namespace App\Actions\Position;

use App\Contracts\Actions\Position\GetPositionActionContract;
use App\Contracts\Services\AbzApiServiceContract;

class GetPositionAction implements GetPositionActionContract
{
    /**
     * @return AbzApiServiceContract
     */
    protected AbzApiServiceContract $api_service;

    /**
     * @param AbzApiServiceContract $api_service
     */
    public function __construct(AbzApiServiceContract $api_service)
    {
        $this->api_service = $api_service;
    }

    /**
     * @return array
     */
    public function __invoke(): array
    {
        return $this->api_service->getPositions();
    }
}
