<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;

use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\BookingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(app()->getLocale());
});

Route::get('/language/{locale}', function ($locale) {
    if (!in_array($locale, ['en', 'es', 'fr'])) {
        abort(400);
    }
    App::setLocale($locale);

    return back();
});

Route::prefix('{locale?}')
    ->where(['locale' => '[a-zA-Z]{2}'])
    ->middleware('setlocale')
    ->group(function () {

        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::get('/how-it-works', [HomeController::class, 'howitworks'])->name('howitworks');
        Route::get('/become-courier', [HomeController::class, 'become_courier'])->name('become_courier');
        Route::get('/contact-us', [HomeController::class, 'contact_us'])->name('contact_us');
        Route::get('/privacy', [HomeController::class, 'privacy'])->name('privacy');
        Route::get('/terms', [HomeController::class, 'terms'])->name('terms');

        Route::group(['prefix' => 'booking'], function () {
            Route::get('/{step?}', [BookingController::class, 'index'])->name('booking');
        });


        Route::get('/home', function () {
            return view('dashboard');
        })->middleware(['auth'])->name('dashboard');
    });
require __DIR__ . '/auth.php';
