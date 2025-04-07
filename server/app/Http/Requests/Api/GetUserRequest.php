<?php

namespace App\Http\Requests\Api;

use App\DataTransferObjects\User\GetUserDTO;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use App\Http\Requests\BaseApiFormRequest;

class GetUserRequest extends BaseApiFormRequest
{
    /**
     * @return void
     */
    protected function prepareForValidation():void
    {
        $this->merge([
            'user' => $this->route('user'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'user' => ['required', 'integer'],
        ];
    }

    /**
     * @return GetUserDTO
     * @throws UnknownProperties
     */
    public function toDTO(): GetUserDTO
    {
        return new GetUserDTO(
            id: (int) $this->route('user')
        );
    }
}
