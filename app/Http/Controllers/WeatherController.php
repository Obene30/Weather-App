<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function index()
    {
        return view('weather');
    }

    public function getWeather(Request $request)
    {
        $request->validate(['city' => 'required|string']);
        $city = $request->input('city');
        $apiKey = "38721ed063a246841201a2c93d5529da"; // Hardcoded API Key

        // API URL for current weather
        $weatherUrl = "https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric";
        $weatherResponse = Http::get($weatherUrl);

        // API URL for 5-day forecast
        $forecastUrl = "https://api.openweathermap.org/data/2.5/forecast?q={$city}&appid={$apiKey}&units=metric";
        $forecastResponse = Http::get($forecastUrl);

        // Handle API errors
        if ($weatherResponse->failed() || $forecastResponse->failed()) {
            return back()->withErrors(['city' => 'Could not fetch weather data. Please try again.']);
        }

        $weatherData = $weatherResponse->json();
        $forecastData = $forecastResponse->json();

        return view('weather', compact('weatherData', 'forecastData', 'city'));
    }

    public function show(\Illuminate\Http\Request $request)
{
    $city = $request->input('city', 'Lagos'); // works for both GET ?city=… and POST
    // ... fetch/return weather ...
    return response()->json(['city' => $city, 'ok' => true]);
}


    // ✅ Add this missing function
    public function forecast()
    {
        return view('forecast');
    }
}
