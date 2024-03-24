<?php

use Illuminate\Support\Facades\Route;


Route::controller('AuthController')->group(function () {

    Route::post('login', 'login');

});


Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('logout', 'AuthController@logout');

    Route::middleware(['check-route-access'])->group(function () {

        Route::prefix('medications')->name('medications.')->controller('MedicationController')->group(function () {

            Route::get('/', 'index')->name('index');

            Route::post('store', 'store')->name('store');

            Route::get('show/{medication}', 'show')->name('show');

            Route::put('update/{medication}', 'update')->name('update');

            Route::delete('delete/{medication}', 'destroy')->name('delete');

            Route::delete('force-delete/{medication}', 'forceDelete')->name('force-delete');

        });

        Route::prefix('customers')->name('customers.')->controller('CustomerController')->group(function () {

            Route::get('/', 'index')->name('index');

            Route::post('store', 'store')->name('store');

            Route::get('show/{customer}', 'show')->name('show');

            Route::put('update/{customer}', 'update')->name('update');

            Route::delete('delete/{customer}', 'destroy')->name('delete');

            Route::delete('force-delete/{customer}', 'forceDelete')->name('force-delete');

        });

    });

});
