<?php

namespace App\Actions\User;

use App\Contracts\Actions\User\UserStoreActionContract;
use App\Contracts\Services\AbzApiServiceContract;
use App\DataTransferObjects\User\UserStoreDTO;

class UserStoreAction implements UserStoreActionContract
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
     * @param UserStoreDTO $data
     * @return array
     */
    public function __invoke(UserStoreDTO $data): array
    {
        return $this->api_service->setUsers($data);
    }
}
