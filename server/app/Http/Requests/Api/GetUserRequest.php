<?php

namespace App\Http\Requests\Api;

use App\DataTransferObjects\User\GetUserDTO;
use App\Facades\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class GetUserRequest extends FormRequest
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
            'page' => [
                'int',
            ],
            'count' => [
                'int',
            ],
        ];
    }

    /**
     * @return GetUserDTO
     * @throws UnknownProperties
     */
    public function toDTO(): GetUserDTO
    {
        return new GetUserDTO(
            page: $this->collect()->get('page'),
            count: $this->collect()->get('count'),
        );
    }
}
