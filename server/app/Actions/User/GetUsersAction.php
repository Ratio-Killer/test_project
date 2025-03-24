<?php

namespace App\Actions\User;

use App\Contracts\Actions\User\GetUsersActionContract;
use App\Contracts\Services\AbzApiServiceContract;
use App\DataTransferObjects\User\GetUsersDTO;

class GetUsersAction implements GetUsersActionContract
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
     * @param GetUsersDTO $data
     * @return array
     */
    public function __invoke(GetUsersDTO $data): array
    {
        return $this->api_service->getUsers($data);
    }
}
