@extends('layout')

@section('content')

<div class="bg-white shadow-lg rounded-lg p-6 w-full max-w-lg mx-auto mt-6">
    <h2 class="text-2xl font-semibold text-gray-700 mb-4">🌎 Weather Dashboard</h2>

    <!-- Search Form -->
    <form action="/weather" method="POST" class="mb-4">
        @csrf
        <div class="flex space-x-2">
            <input type="text" name="city" class="flex-1 p-2 border border-gray-400 rounded focus:ring focus:ring-blue-300" placeholder="Enter city name" required>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Search</button>
        </div>
    </form>

    <!-- Error Message -->
    @if ($errors->any())
        <p class="text-red-500 text-center font-semibold">{{ $errors->first('city') }}</p>
    @endif

    <!-- Display Current Weather -->
    @isset($weatherData)
        <div class="mt-4 p-4 bg-gradient-to-b from-blue-100 to-blue-300 rounded-lg text-center shadow-lg">
            <h2 class="text-2xl font-semibold text-gray-800">{{ $city }}</h2>
            <p class="text-gray-600 capitalize">{{ $weatherData['weather'][0]['description'] }}</p>
            
            <div class="flex justify-center items-center space-x-4 mt-3">
                <img src="http://openweathermap.org/img/wn/{{ $weatherData['weather'][0]['icon'] }}@2x.png" alt="Weather Icon">
                <p class="text-4xl font-bold text-gray-900">{{ $weatherData['main']['temp'] }}°C</p>
            </div>

            <p class="text-gray-700 font-medium">💧 Humidity: {{ $weatherData['main']['humidity'] }}%</p>
            <p class="text-gray-700 font-medium">🌬️ Wind Speed: {{ $weatherData['wind']['speed'] }} m/s</p>
        </div>
    @endisset

    <!-- Divider -->
    <div class="border-t border-gray-300 my-6"></div>

    <!-- Display 5-Day Forecast -->
    @isset($forecastData)
        <h2 class="text-xl font-semibold text-gray-700 mt-6 text-center">📆 5-Day Forecast</h2>
        <div class="grid grid-cols-2 gap-4 mt-4">
            @foreach ($forecastData['list'] as $index => $forecast)
                @if ($index % 8 == 0) <!-- Show one forecast per day -->
                    <div class="bg-blue-100 p-4 rounded-lg text-center shadow-lg hover:bg-blue-200 transition">
                        <p class="font-semibold text-gray-700">{{ \Carbon\Carbon::parse($forecast['dt_txt'])->format('D, M d') }}</p>
                        <img src="http://openweathermap.org/img/wn/{{ $forecast['weather'][0]['icon'] }}.png" class="mx-auto">
                        <p class="text-lg font-bold text-gray-900">{{ $forecast['main']['temp'] }}°C</p>
                        <p class="text-gray-600 text-sm">{{ $forecast['weather'][0]['description'] }}</p>
                    </div>
                @endif
            @endforeach
        </div>
    @endisset
</div>

@endsection
