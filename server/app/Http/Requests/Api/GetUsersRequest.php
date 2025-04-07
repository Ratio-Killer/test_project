<?php

namespace App\Http\Requests\Api;

use App\DataTransferObjects\User\GetUsersDTO;
use App\Http\Requests\BaseApiFormRequest;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class GetUsersRequest extends BaseApiFormRequest
{
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
