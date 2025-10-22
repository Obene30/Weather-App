<?php

use App\Http\Controllers\WeatherController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WeatherController::class, 'index']);
Route::post('/weather', [WeatherController::class, 'getWeather']);



Route::get('/', [WeatherController::class, 'index']);
Route::post('/weather', [WeatherController::class, 'getWeather']);
Route::get('/forecast', [WeatherController::class, 'forecast']);  
Route::get('/about', [PageController::class, 'about']);
Route::get('/settings', [PageController::class, 'settings']);
Route::match(['get','post'], '/weather', [WeatherController::class, 'show']);



Route::get('/', [WeatherController::class, 'index']);
Route::post('/weather', [WeatherController::class, 'getWeather']);







Route::get('/contact', [ContactController::class, 'index']);
Route::post('/contact', [ContactController::class, 'sendInquiry']);



