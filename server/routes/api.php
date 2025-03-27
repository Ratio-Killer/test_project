<?php

use App\Http\Controllers\Api\User\PositionController;
use App\Http\Controllers\Api\User\UserController;
use Illuminate\Support\Facades\Route;


Route::apiResource('/users', UserController::class)->only(['index', 'store', 'show']);
Route::apiResource('/positions', PositionController::class)->only(['index']);

