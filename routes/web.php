<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index'])->name('index');

Route::inertia('/home', 'Home')->name('client.home');
Route::inertia('/dashboard', 'Dashboard')->name('admin.dashboard');

Route::inertia('/auth', 'Auth')->name('auth');
Route::inertia('/invite', 'Invite')->name('invite');
Route::inertia('/requests', 'Request')->name('requests');

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login')->name('login');
    Route::post('/request-access', 'register')->name('request-access');
    Route::post('/logout', 'logout')->name('logout');
});
