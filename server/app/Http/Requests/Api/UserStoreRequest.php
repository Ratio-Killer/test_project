<?php

namespace App\Http\Requests\Api;

use App\DataTransferObjects\User\UserStoreDTO;
use App\Http\Requests\BaseApiFormRequest;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class UserStoreRequest extends BaseApiFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:2'
            ],
            'email' => [
                'required',
                'email:rfc,strict',
                'max:255',
                'unique:users,email'
            ],
            'phone' => [
                'required',
                'string',
                'unique:users,phone'
            ],
            'position_id' => [
                'required',
                'integer'
            ],
            'photo' => [
                'required',
                'max:5120'
            ],
        ];
    }

    /**
     * @return UserStoreDTO
     * @throws UnknownProperties
     */
    public function toDTO(): UserStoreDTO
    {
        return new UserStoreDTO(
            name: $this->get('name'),
            email: $this->get('email'),
            phone: $this->get('phone'),
            position_id: $this->get('position_id'),
            photo: $this->file('photo'),
        );
    }
}
