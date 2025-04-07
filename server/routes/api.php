<?php

use App\Http\Controllers\Api\Position\PositionController;
use App\Http\Controllers\Api\Token\TokenController;
use App\Http\Controllers\Api\User\UserController;
use Illuminate\Support\Facades\Route;


Route::apiResource('/users', UserController::class)->only(['index', 'show']);

Route::post('/users', [UserController::class, 'store'])
    ->middleware('registration.token');

Route::apiResource('/positions', PositionController::class)->only(['index']);
Route::apiResource('/token', TokenController::class)->only(['index']);

