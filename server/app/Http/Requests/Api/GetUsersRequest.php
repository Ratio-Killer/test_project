<?php

namespace App\Http\Requests\Api;

use App\DataTransferObjects\User\GetUsersDTO;
use App\Facades\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class GetUsersRequest extends FormRequest
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
                'int','min:1'
            ],
            'count' => [
                'int',
            ],
        ];
    }

    /**
     * @return GetUsersDTO
     * @throws UnknownProperties
     */
    public function toDTO(): GetUsersDTO
    {
        return new GetUsersDTO(
            page: $this->get('page'),
            count: $this->get('count'),
        );
    }
}
