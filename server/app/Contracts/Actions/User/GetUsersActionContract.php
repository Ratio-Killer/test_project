<?php

namespace App\Contracts\Actions\User;

use App\Contracts\Services\AbzApiServiceContract;
use App\DataTransferObjects\User\GetUsersDTO;

interface GetUsersActionContract
{
    /**
     * @param AbzApiServiceContract $api_service
     */
    public function __construct(AbzApiServiceContract $api_service);

    /**
     * @param GetUsersDTO $data
     * @return array
     */
    public function __invoke(GetUsersDTO $data): array;
}
