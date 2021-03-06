<?php

use App\Http\controllers\CastApiController;
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

Route::group(['prefix' => 'v1/'], function() {
    Route::post('referrers/token', [CastApiController::class, 'generateToken'])->middleware(['ip.check', 'throttle:3,2']);
    Route::group(['middleware' => ['ip.check', 'auth:sanctum', 'throttle:10,1']], function() {
        Route::get('referrers/{id}', [CastApiController::class, 'getReferrer']);
    });
});
/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */
