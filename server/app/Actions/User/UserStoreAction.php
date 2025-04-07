<?php

namespace App\Actions\User;

use App\Contracts\Actions\User\UserStoreActionContract;
use App\DataTransferObjects\User\UserStoreDTO;
use App\Models\User;
use App\Traits\Image\ImageTrait;

class UserStoreAction implements UserStoreActionContract
{
    use ImageTrait;
    /**
     * @param UserStoreDTO $data
     * @return array
     */
    public function __invoke(UserStoreDTO $data): array
    {
        $processedPhoto = $this->processImage($data->photo);
        $data->photo = url("images/users/{$processedPhoto->getFilename()}");
        $newUser = User::create($data->toArray());

        return ['user_id' => $newUser->id];
    }
}
