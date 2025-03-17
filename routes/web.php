<?php

use App\Http\Controllers\WeatherController;

Route::get('/', [WeatherController::class, 'index']);
Route::post('/weather', [WeatherController::class, 'getWeather']);



use App\Http\Controllers\PageController;

Route::get('/', [WeatherController::class, 'index']);
Route::post('/weather', [WeatherController::class, 'getWeather']);
Route::get('/forecast', [WeatherController::class, 'forecast']);  // ✅ This should now work
Route::get('/about', [PageController::class, 'about']);
Route::get('/settings', [PageController::class, 'settings']);



Route::get('/', [WeatherController::class, 'index']);
Route::post('/weather', [WeatherController::class, 'getWeather']);





use App\Http\Controllers\ContactController;

Route::get('/contact', [ContactController::class, 'index']);
Route::post('/contact', [ContactController::class, 'sendInquiry']);



