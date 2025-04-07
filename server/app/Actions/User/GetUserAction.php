<?php

namespace App\Actions\User;

use App\Contracts\Actions\User\GetUserActionContract;
use App\DataTransferObjects\User\GetUserDTO;
use App\Exceptions\ApiException;
use App\Http\Resources\UserResource;
use App\Models\User;

class GetUserAction implements GetUserActionContract
{

    /**
     * @param GetUserDTO $data
     * @return array
     * @throws ApiException
     */
    public function __invoke(GetUserDTO $data): array
    {
        $user = User::with('position')->find($data->id);

        if (!$user) {
            throw new ApiException();
        }

        return (new UserResource($user))->resolve();
    }
}
