<?php

namespace App\Contracts\Actions\User;

use App\DataTransferObjects\User\UserStoreDTO;

interface UserStoreActionContract
{
    /**
     * @param UserStoreDTO $data
     * @return array
     */
    public function __invoke(UserStoreDTO $data): array;
}
