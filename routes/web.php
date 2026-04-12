<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index'])->name('index');

Route::inertia('/home', 'Home')->name('client.home');
Route::inertia('/dashboard', 'Dashboard')->name('admin.dashboard');

Route::inertia('/auth', 'Auth')->name('auth');
Route::inertia('/invite', 'Invite')->name('invite');

Route::controller(UserController::class)->group(function() {
    Route::get('/users', 'getPendingUsers')->name('pendingUsers');
    Route::post('/users/{user}/accept', 'acceptUser')->name('users.accept');
    Route::post('/users/{user}/reject', 'rejectUser')->name('users.reject');
});

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login')->name('login');
    Route::post('/request-access', 'register')->name('request-access');
    Route::post('/logout', 'logout')->name('logout');
});
