<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;

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
    return view('auth.login');
});


// Admin
Route::group(['prefix' => 'management'], function () {
    // Authentication
    Auth::routes();

    // Team
    Route::group(['prefix' => 'team'], function () {
        Route::post('create_confirm', [TeamController::class, 'create_confirm'])->name('team_create_confirm');
        Route::post('edit_confirm', [TeamController::class, 'edit_confirm'])->name('team_edit_confirm');
    });

    Route::resource('team', TeamController::class);

    // Employee
    Route::group(['prefix' => 'employee'], function () {
        Route::post('create_confirm', [EmployeeController::class, 'create_confirm'])->name('employee_create_confirm');
        Route::post('edit_confirm', [EmployeeController::class, 'edit_confirm'])->name('employee_edit_confirm');
    });

    Route::resource('employee', EmployeeController::class);

});


