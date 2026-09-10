<?php

use App\Http\Controllers\Landing\LandingController;
use Illuminate\Support\Facades\Route;

Route::get('/', LandingController::class)->name('home');

Route::inertia('/setup', 'Setup/Index')->name('setup');
