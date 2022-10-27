<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\UserController;

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

//booking api's
Route::group(['prefix' => '/{lang}/'], function () {

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/check-phone-number', [UserController::class, 'check_phone_number']);
    Route::post('/register', [UserController::class, 'register']);

    Route::group(['prefix' => 'booking'], function () {
        Route::get('/clear-booking', [BookingController::class, 'clear_booking']);
        Route::get('/steps', [BookingController::class, 'steps']);
        Route::post('/', [BookingController::class, 'booking']);
    });


    Route::get('/countries', [AuthController::class, 'countries']);

    Route::middleware(['auth:sanctum'])->group(function () {
        
    });
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
