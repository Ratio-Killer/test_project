<?php

use App\Http\Controllers\Api\User\PositionController;
use App\Http\Controllers\Api\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/users', UserController::class)->only(['index', 'store', 'show']);
Route::apiResource('/positions', PositionController::class)->only(['index']);

