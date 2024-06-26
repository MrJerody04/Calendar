<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


use \App\Http\Controllers\ScheduleController;
use \App\Http\Controllers\CustomAuthController;


Route::get('dashboard', [CustomAuthController::class, 'dashboard']);
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

Route::middleware('auth')->group(function () {
    Route::get('/', [ScheduleController::class, 'index']);
    Route::get('/events', [ScheduleController::class, 'getEvents']);
    Route::view('add-schedule', 'schedule.add');
    Route::post('create-schedule', [ScheduleController::class, 'create']);
    Route::get('/events', [ScheduleController::class, 'getEvents']);
    Route::get('/schedule/delete/{id}', [ScheduleController::class, 'deleteEvent']);
    Route::post('/schedule/{id}', [ScheduleController::class, 'update']);
    Route::post('/schedule/resize/{eventId}', [ScheduleController::class, 'resize']);
    Route::get('/events/search', [ScheduleController::class, 'search']);
    Route::get('/event_details/{id}', [ScheduleController::class, 'details']);

    Route::post('/ucast', [ScheduleController::class, 'ucast']);
    Route::post('ucast_update', [ScheduleController::class, 'ucast_update']);

    Route::view('add-schedule', 'schedule.add');
    Route::post('create-schedule', [ScheduleController::class, 'create']);


    Route::get('/test', function () {
        return view('welcome');
    });

    Route::get('/rezervace', function () {
        return view('rezervace');
    });
});
