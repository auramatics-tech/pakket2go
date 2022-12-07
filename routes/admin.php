<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrdersController;

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/login', [AdminController::class, 'login'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'check_login'])->name('admin.login.check');

    Route::group(['middleware' => 'auth.admin'], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dasbhoard');
        Route::get('/orders/{status?}', [OrdersController::class, 'orders'])->name('admin.orders');
    });
});
