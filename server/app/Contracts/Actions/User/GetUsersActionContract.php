<?php

namespace App\Contracts\Actions\User;

use App\DataTransferObjects\User\GetUsersDTO;

interface GetUsersActionContract
{

    /**
     * @param GetUsersDTO $data
     * @return array
     */
    public function __invoke(GetUsersDTO $data): array;
}
