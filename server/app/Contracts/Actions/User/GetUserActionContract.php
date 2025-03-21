<?php

namespace App\Contracts\Actions\User;

use App\Contracts\Services\AbzApiServiceContract;
use App\DataTransferObjects\User\GetUserDTO;

interface GetUserActionContract
{
    /**
     * @param AbzApiServiceContract $api_service
     */
    public function __construct(AbzApiServiceContract $api_service);

    /**
     * @param GetUserDTO $data
     * @return array
     */
    public function __invoke(GetUserDTO $data): array;
}
