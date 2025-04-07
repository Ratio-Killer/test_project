<?php

namespace App\Contracts\Actions\User;

use App\DataTransferObjects\User\GetUserDTO;

interface GetUserActionContract
{
    /**
     * @param GetUserDTO $data
     * @return array
     */
    public function __invoke(GetUserDTO $data): array;
}
