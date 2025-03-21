<?php

namespace App\Http\Controllers\Api\User;

use App\Contracts\Actions\User\GetUserActionContract;
use App\Contracts\Actions\User\UserStoreActionContract;
use App\Facades\ApiResponse;
use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\GetUserRequest;
use App\Http\Requests\Api\UserStoreRequest;
use Illuminate\Http\JsonResponse;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class UserController extends Controller
{
    /**
     * @param GetUserRequest $request
     * @param GetUserActionContract $action
     * @return mixed
     * @throws UnknownProperties
     */

    public function index(GetUserRequest $request, GetUserActionContract $action): JsonResponse
    {
        return ApiResponse::success(
            __('user/user.response.200.index'),
            $action($request->toDTO()),
        );
    }

    /**
     * @param UserStoreRequest $request
     * @param UserStoreActionContract $action
     * @return JsonResponse
     * @throws UnknownProperties
     */
    public function store(UserStoreRequest $request, UserStoreActionContract $action): JsonResponse
    {
        return ApiResponse::success(
            __('user/user.response.200.create'),
            $action($request->toDTO()),
        );
    }
}
