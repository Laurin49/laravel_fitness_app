<?php

use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\ExerciseApiController;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\WorkoutApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('users', UserApiController::class);
Route::apiResource('workouts', WorkoutApiController::class);
Route::apiResource('categories', CategoryApiController::class);
Route::apiResource('exercises', ExerciseApiController::class);