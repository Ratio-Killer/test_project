<?php

namespace App\Http\Controllers\Api\Token;

use App\Contracts\Actions\Token\GetTokenActionContract;
use App\Facades\ApiResponse;
use App\Http\Controllers\Api\Controller;
use Illuminate\Http\JsonResponse;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class TokenController extends Controller
{
    /**
     * @param GetTokenActionContract $action
     * @return mixed
     * @throws UnknownProperties
     */
    public function index(GetTokenActionContract $action): JsonResponse
    {
        return ApiResponse::success(
            __('token/token.response.200.index'),
            $action()
        );
    }
}
