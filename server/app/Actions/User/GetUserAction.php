<?php

namespace App\Actions\User;

use App\Contracts\Actions\User\GetUserActionContract;
use App\Contracts\Services\AbzApiServiceContract;
use App\DataTransferObjects\User\GetUserDTO;

class GetUserAction implements GetUserActionContract
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
     * @param GetUserDTO $data
     * @return array
     */
    public function __invoke(GetUserDTO $data): array
    {
        return $this->api_service->getUsers($data);
    }
}
