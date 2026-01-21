<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware(['checkRole:user'])->group(function () {
    Route::inertia('/', 'Home')->name('home');
});

Route::middleware(['checkRole:admin'])->group(function () {
    Route::inertia('/dashboard', 'Dashboard')->name('dashboard');
});

Route::inertia('/auth', 'Auth')->name('auth');

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login')->name('login');
    Route::post('/register', 'register')->name('register');
    Route::post('/logout', 'logout')->name('logout');
});