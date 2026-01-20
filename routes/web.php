<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'checkRole:user'])->group(function () {
    Route::inertia('/', 'Home')->name('home');
});

Route::middleware(['auth', 'checkRole:admin'])->group(function () {
    Route::inertia('/dashboard', 'Dashboard')->name('dashboard');
});

Route::inertia('/auth', 'Auth')->name('auth');

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login')->name('login');
    Route::post('/register', 'register')->name('register');
});