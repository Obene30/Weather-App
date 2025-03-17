@extends('layout')

@section('content')

<div class="bg-white shadow-lg rounded-lg p-6 w-full max-w-lg mx-auto mt-6">
    <h2 class="text-2xl font-semibold text-gray-700 text-center mb-4">📅 5-Day Weather Forecast</h2>

    <!-- Check if Forecast Data is Available -->
    @isset($forecastData)
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            @foreach ($forecastData['list'] as $index => $forecast)
                @if ($index % 8 == 0) <!-- Show one forecast per day -->
                    <div class="bg-blue-100 p-4 rounded-lg text-center shadow-lg hover:bg-blue-200 transition">
                        <p class="font-semibold text-gray-700">{{ \Carbon\Carbon::parse($forecast['dt_txt'])->format('D, M d') }}</p>
                        <img src="http://openweathermap.org/img/wn/{{ $forecast['weather'][0]['icon'] }}.png" class="mx-auto">
                        <p class="text-lg font-bold text-gray-900">{{ $forecast['main']['temp'] }}°C</p>
                        <p class="text-gray-600 text-sm capitalize">{{ $forecast['weather'][0]['description'] }}</p>
                        <p class="text-gray-700">💧 Humidity: {{ $forecast['main']['humidity'] }}%</p>
                        <p class="text-gray-700">🌬️ Wind: {{ $forecast['wind']['speed'] }} m/s</p>
                    </div>
                @endif
            @endforeach
        </div>
    @else
        <p class="text-gray-600 text-center mt-4">Enter a city in the home page to view the forecast.</p>
    @endisset

</div>

@endsection
