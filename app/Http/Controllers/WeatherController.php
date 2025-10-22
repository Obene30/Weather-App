<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function index()
    {
        // Renders the weather form/page
        return view('weather');
    }

    // Handles both GET (querystring) and POST (form)
    public function getWeather(Request $request)
    {
        // For POST we require city; for GET we make it optional with a default
        if ($request->isMethod('post')) {
            $request->validate(['city' => 'required|string']);
        }

        $city   = $request->input('city', 'Lagos');
        $apiKey = '38721ed063a246841201a2c93d5529da'; // consider moving to env: WEATHER_API_KEY

        $weatherUrl  = "https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric";
        $forecastUrl = "https://api.openweathermap.org/data/2.5/forecast?q={$city}&appid={$apiKey}&units=metric";

        $weatherResponse  = Http::get($weatherUrl);
        $forecastResponse = Http::get($forecastUrl);

        if ($weatherResponse->failed() || $forecastResponse->failed()) {
            // On GET return JSON error; on POST go back with error
            if ($request->isMethod('get')) {
                return response()->json(['ok' => false, 'error' => 'Could not fetch weather data'], 502);
            }
            return back()->withErrors(['city' => 'Could not fetch weather data. Please try again.']);
        }

        $weatherData  = $weatherResponse->json();
        $forecastData = $forecastResponse->json();

        // If the caller is GET /weather?city=... (e.g., you testing in the browser bar), return JSON
        if ($request->isMethod('get')) {
            return response()->json([
                'ok'           => true,
                'city'         => $city,
                'weather'      => $weatherData,
                'forecast_5d'  => $forecastData,
            ]);
        }

        // Otherwise render the page as before
        return view('weather', compact('weatherData', 'forecastData', 'city'));
    }

    public function forecast()
    {
        return view('forecast');
    }
}
