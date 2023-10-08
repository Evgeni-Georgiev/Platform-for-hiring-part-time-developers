<?php

use App\Http\Controllers\Api\DevelopersApiController;
use App\Http\Controllers\Api\HireApiController;
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

Route::group(['namespace' => 'Developers'], function() {

    Route::get('/developer', [DevelopersApiController::class, 'index']);

    Route::get('/developer/{id}', [DevelopersApiController::class, 'show'])->name('api.v1.developer.show');

    Route::post('/developer', [DevelopersApiController::class, 'store']);

    Route::put('/developer/{id}', [DevelopersApiController::class, 'update']);

    Route::delete('/developer/{id}', [DevelopersApiController::class, 'destroy']);
});

Route::group(['namespace' => 'Hire'], function() {

    Route::get('/hire', [HireApiController::class, 'index']);

    Route::post('/hire', [HireApiController::class, 'create']);

    Route::delete('/hire/{id}', [HireApiController::class, 'destroy']);
});
