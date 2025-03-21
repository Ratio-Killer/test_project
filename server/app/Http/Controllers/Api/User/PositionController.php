<?php

namespace App\Http\Controllers\Api\User;

use App\Contracts\Actions\Position\GetPositionActionContract;
use App\Facades\ApiResponse;
use App\Http\Controllers\Api\Controller;
use Illuminate\Http\JsonResponse;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class PositionController extends Controller
{
    /**
     * @param GetPositionActionContract $action
     * @return mixed
     * @throws UnknownProperties
     */

    public function index(GetPositionActionContract $action): JsonResponse
    {
        return ApiResponse::success(
            __('position/position.response.200.index'),
            $action(),
        );
    }

}
