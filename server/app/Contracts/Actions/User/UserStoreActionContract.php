<?php

namespace App\Contracts\Actions\User;

use App\Contracts\Services\AbzApiServiceContract;
use App\DataTransferObjects\User\UserStoreDTO;
use App\Services\AbzApiService;

interface UserStoreActionContract
{
    /**
     * @param AbzApiServiceContract $api_service
     */
    public function __construct(AbzApiServiceContract $api_service);

    /**
     * @param UserStoreDTO $data
     * @return array
     */
    public function __invoke(UserStoreDTO $data): array;
}
