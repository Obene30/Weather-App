<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactController;

// Weather pages
Route::get('/', [WeatherController::class, 'index']);
Route::match(['get','post'], '/weather', [WeatherController::class, 'getWeather'])->name('weather');
Route::get('/forecast', [WeatherController::class, 'forecast']);

// Other pages
Route::get('/about', [PageController::class, 'about']);
Route::get('/settings', [PageController::class, 'settings']);

// Contact
Route::get('/contact', [ContactController::class, 'index']);
Route::post('/contact', [ContactController::class, 'sendInquiry']);
