<?php

namespace App\Actions\User;

use App\Contracts\Actions\User\UserStoreActionContract;
use App\DataTransferObjects\User\UserStoreDTO;
use App\Exceptions\ApiException;
use App\Models\User;
use App\Traits\Image\ImageTrait;
use Illuminate\Database\QueryException;

class UserStoreAction implements UserStoreActionContract
{
    use ImageTrait;

    /**
     * @param UserStoreDTO $data
     * @return array
     * @throws ApiException
     */
    public function __invoke(UserStoreDTO $data): array
    {
        try {
            $processedPhoto = $this->processImage($data->photo);
            $data->photo = url("images/users/{$processedPhoto->getFilename()}");
            $newUser = User::create($data->toArray());

            return ['user_id' => $newUser->id];
        } catch (QueryException $e) {
            if ($e->errorInfo[1] === 1062) {
                throw new ApiException();
            }
            throw $e;
        }
    }
}
