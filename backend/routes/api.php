<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\WelcomeController;
use App\Http\Controllers\Api\RoadController;


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

Route::group(['middleware' => 'api'], function () {
    Route::get('welcome', [WelcomeController::class, 'getRoads']);
    Route::get('roads', [RoadController::class, 'getRoads']);
    Route::get('road/{roadId}', [RoadController::class, 'getRoad']);
    Route::get('search_roads', [RoadController::class, 'searchRoads']);
});
