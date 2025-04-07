<?php

namespace App\Http\Controllers\Api\User;

use App\Contracts\Actions\User\GetUserActionContract;
use App\Contracts\Actions\User\GetUsersActionContract;
use App\Contracts\Actions\User\UserStoreActionContract;
use App\Exceptions\ApiException;
use App\Facades\ApiResponse;
use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\GetUserRequest;
use App\Http\Requests\Api\GetUsersRequest;
use App\Http\Requests\Api\UserStoreRequest;
use Illuminate\Http\JsonResponse;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class UserController extends Controller
{
    /**
     * @param GetUsersRequest $request
     * @param GetUsersActionContract $action
     * @return mixed
     * @throws UnknownProperties
     */
    public function index(GetUsersRequest $request, GetUsersActionContract $action): JsonResponse
    {
        try {
            return ApiResponse::success(
                __('user/user.response.200.index'),
                $action($request->toDTO())
            );
        } catch (ApiException) {
            return ApiResponse::notFound(__('user/user.response.404.page_not_found'));
        }
    }

    /**
     * @param UserStoreRequest $request
     * @param UserStoreActionContract $action
     * @return JsonResponse
     * @throws UnknownProperties
     */
    public function store(UserStoreRequest $request, UserStoreActionContract $action): JsonResponse
    {
        try {
            return ApiResponse::success(
                __('user/user.response.200.store'),
                $action($request->toDTO()),
            );
        } catch (ApiException) {
            return ApiResponse::error(__('user/user.response.409.duplicate'), [], 409);
        }
    }

    /**
     * @param GetUserRequest $request
     * @param GetUserActionContract $action
     * @return mixed
     * @throws UnknownProperties
     */
    public function show(GetUserRequest $request, GetUserActionContract $action): JsonResponse
    {
        try {
            return ApiResponse::success(
                __('user/user.response.200.show'),
                $action($request->toDTO()),
            );
        } catch (ApiException) {
            return ApiResponse::notFound(__('user/user.response.404.user_not_found'));
        }
    }

}
