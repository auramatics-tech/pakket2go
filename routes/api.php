<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CourierController;
use App\Http\Controllers\Api\ChatController;

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
    // Type => terms, privacy, appversion
    Route::get('/get-{type}', 'DashboardController@getTermservice');

    Route::group(['prefix' => 'booking'], function () {
        Route::get('/clear-booking', [BookingController::class, 'clear_booking']);
        Route::get('/steps', [BookingController::class, 'steps']);
        Route::post('/', [BookingController::class, 'booking']);
    });


    Route::get('/countries', [AuthController::class, 'countries']);
    Route::get("nearbyriders", [UserController::class, 'nearbyriders']);

    Route::post('/reset-password', [UserController::class, 'reset_password']);

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('/update-profile', [UserController::class, 'update_profile']);
        Route::post('/update-password', [UserController::class, 'update_password']);
        Route::get('/bookings', [UserController::class, 'my_bookings']);
        Route::get('/booking-details', [UserController::class, 'booking_details']);
        Route::post('/cancel-booking', [UserController::class, 'cancel_booking']);
        Route::get('/last-location', [BookingController::class, 'last_location']);

        Route::post('/booking/feedback', [BookingController::class, 'feedback']);
        Route::get('/booking/invoice', [BookingController::class, 'invoice']);

        Route::group(['prefix' => 'courier'], function () {
            Route::post('/update-documents', [CourierController::class, 'update_documents']);
            Route::get('/bookings/{status?}', [CourierController::class, 'bookings']);
            Route::post('/booking/{status}', [CourierController::class, 'update_booking']);
            Route::get('/earnings', [CourierController::class, 'earnings']);
            Route::get('/last-location', [CourierController::class, 'last_location']);
            Route::post('/update-location', [CourierController::class, 'update_location']);
        });

        Route::post("contact-us", [UserController::class, 'contact_us']);

        // Chat api's
        Route::group(['prefix' => 'chat'], function () {

            Route::get('/allchats', [ChatController::class, 'all_chats']);
            Route::match(['get', 'post'], '/conversation', [ChatController::class, 'conversation']);
        });
    });
});
