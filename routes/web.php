<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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
    // Login
    Route::get('/login', [AuthController::class, 'login'])->name('admin.login');
    Route::post('/post_login', [AuthController::class, 'postLogin'])->name('admin.post_login');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

    // Team
    Route::group(['prefix' => 'team','middleware' => ['auth.checklogin']], function () {
        Route::post('create_confirm', [TeamController::class, 'createConfirm'])->name('team_create_confirm');
        Route::post('edit_confirm', [TeamController::class, 'editConfirm'])->name('team_edit_confirm');
    });
    Route::resource('team', TeamController::class)->middleware('auth.checklogin');

    // Employee
    Route::group(['prefix' => 'employee','middleware' => ['auth.checklogin']], function () {
        Route::post('create_confirm', [EmployeeController::class, 'createConfirm'])->name('employee_create_confirm');
        Route::post('edit_confirm', [EmployeeController::class, 'editConfirm'])->name('employee_edit_confirm');

        Route::get('export_file/csv', [EmployeeController::class, 'exportFile'])->name('employee.export_file');
    });
    Route::resource('employee', EmployeeController::class)->middleware('auth.checklogin');
});


