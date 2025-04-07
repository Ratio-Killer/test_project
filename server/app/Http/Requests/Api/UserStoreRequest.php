<?php

namespace App\Http\Requests\Api;

use App\DataTransferObjects\User\UserStoreDTO;
use App\Facades\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class UserStoreRequest extends FormRequest
{
    /**
     * Handle a failed validation attempt.
     *
     * @param Validator $validator
     * @return HttpResponseException
     */
    public function failedValidation(Validator $validator): HttpResponseException
    {
        throw new HttpResponseException(
            ApiResponse::validation(
                __('validation.custom.validation'),
                $validator->errors()->toArray()
            )
        );
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required', 'string', 'min:2'
            ],
            'email' => [
                'required', 'email:rfc'
            ],
            'phone' => [
                'required', 'string'
            ],
            'position_id' => [
                'required', 'integer'
            ],
            'photo' => [
                'required', 'max:5120'
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
