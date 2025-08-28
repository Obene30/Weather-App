@extends('layout')

@section('content')
<div class="min-h-[85vh] py-8">
    <div class="bg-white/80 dark:bg-gray-900/70 backdrop-blur shadow-xl rounded-2xl p-6 sm:p-8 w-full max-w-3xl mx-auto border border-gray-200/60 dark:border-gray-800">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 dark:text-gray-100 tracking-tight">
                🌎 Weather Dashboard
            </h2>
            {{-- Optional badge --}}
            <span class="hidden sm:inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 dark:bg-blue-900/40 dark:text-blue-200 border border-blue-200/50 dark:border-blue-800">
                Live
            </span>
        </div>

        <!-- Search Form -->
        <form action="/weather" method="POST" class="mb-6" role="search" aria-label="City weather search">
            @csrf
            <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                <label for="city" class="sr-only">City</label>
                <input
                    id="city"
                    type="text"
                    name="city"
                    class="flex-1 p-3 rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition"
                    placeholder="Enter city name (e.g., London)"
                    required
                >
                <button
                    type="submit"
                    class="inline-flex justify-center items-center gap-2 bg-blue-600 text-white px-5 py-3 rounded-xl font-semibold hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-500/30 transition shadow-sm"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m21 21-4.35-4.35M11 19a8 8 0 1 1 0-16 8 8 0 0 1 0 16z"/>
                    </svg>
                    Search
                </button>
            </div>
        </form>

        <!-- Error Message -->
        @if ($errors->any())
            <p class="text-red-600 dark:text-red-400 text-center font-semibold bg-red-50/60 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-xl p-3">
                {{ $errors->first('city') }}
            </p>
        @endif

        <!-- Display Current Weather -->
        @isset($weatherData)
            <div class="mt-6 p-6 bg-gradient-to-b from-blue-100/70 to-blue-200/70 dark:from-blue-950/40 dark:to-blue-900/30 rounded-2xl text-center shadow-inner border border-blue-200/50 dark:border-blue-800/50">
                <h3 class="text-2xl font-extrabold text-gray-900 dark:text-gray-100">
                    {{ $city }}
                </h3>
                <p class="text-gray-700 dark:text-gray-300 capitalize">
                    {{ $weatherData['weather'][0]['description'] }}
                </p>

                <div class="flex flex-col sm:flex-row justify-center items-center gap-4 mt-4">
                    <img
                        src="https://openweathermap.org/img/wn/{{ $weatherData['weather'][0]['icon'] }}@2x.png"
                        alt="Weather icon"
                        loading="lazy"
                        class="h-20 w-20"
                    >
                    <p class="text-5xl sm:text-6xl font-black text-gray-900 dark:text-gray-100 tracking-tight">
                        {{ round($weatherData['main']['temp']) }}°C
                    </p>
                </div>

                <div class="mt-4 grid grid-cols-2 gap-3 sm:w-2/3 mx-auto">
                    <div class="rounded-xl bg-white/70 dark:bg-gray-800/60 border border-gray-200/70 dark:border-gray-700 p-3">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Humidity</p>
                        <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">💧 {{ $weatherData['main']['humidity'] }}%</p>
                    </div>
                    <div class="rounded-xl bg-white/70 dark:bg-gray-800/60 border border-gray-200/70 dark:border-gray-700 p-3">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Wind Speed</p>
                        <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">🌬️ {{ $weatherData['wind']['speed'] }} m/s</p>
                    </div>
                </div>
            </div>
        @endisset

        <!-- Divider -->
        <div class="border-t border-gray-200 dark:border-gray-800 my-8"></div>

        <!-- Display 5-Day Forecast -->
        @isset($forecastData)
            <h3 class="text-xl sm:text-2xl font-bold text-gray-800 dark:text-gray-100 text-center">
                📆 5-Day Forecast
            </h3>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4 mt-5">
                @foreach ($forecastData['list'] as $index => $forecast)
                    @if ($index % 8 == 0) <!-- Show one forecast per day -->
                        <div class="group bg-blue-50/70 dark:bg-blue-900/20 border border-blue-200/60 dark:border-blue-800 rounded-2xl p-4 text-center shadow-sm hover:shadow-md hover:-translate-y-0.5 transition">
                            <p class="font-semibold text-gray-700 dark:text-gray-200">
                                {{ \Carbon\Carbon::parse($forecast['dt_txt'])->format('D, M d') }}
                            </p>
                            <img
                                src="https://openweathermap.org/img/wn/{{ $forecast['weather'][0]['icon'] }}.png"
                                class="mx-auto h-14 w-14"
                                alt="Forecast icon"
                                loading="lazy"
                            >
                            <p class="text-xl font-bold text-gray-900 dark:text-gray-100">
                                {{ round($forecast['main']['temp']) }}°C
                            </p>
                            <p class="text-gray-600 dark:text-gray-300 text-sm capitalize">
                                {{ $forecast['weather'][0]['description'] }}
                            </p>
                        </div>
                    @endif
                @endforeach
            </div>
        @endisset
    </div>

    <!-- Footer -->
    <footer class="max-w-3xl mx-auto mt-8">
        <div class="relative overflow-hidden rounded-2xl border border-gray-200 dark:border-gray-800 bg-white/80 dark:bg-gray-900/70 backdrop-blur p-4 sm:p-5 shadow-md">
            <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500"></div>
            <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
                <p class="text-sm text-gray-600 dark:text-gray-300">
                    Built with care • <span class="font-medium">Weather Dashboard</span>
                </p>
                <a
                    href="#"
                    class="inline-flex items-center gap-2 text-sm font-semibold text-blue-700 dark:text-blue-300 hover:underline"
                    aria-label="Powered by AgenticLearnPro"
                    title="Powered by AgenticLearnPro"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2a10 10 0 1 0 10 10A10.011 10.011 0 0 0 12 2Zm1 14.93V13h3.93A7.006 7.006 0 0 1 13 16.93ZM7.07 11H11V7.07A7.006 7.006 0 0 0 7.07 11ZM11 13H7.07A7.006 7.006 0 0 0 11 16.93Zm2-5.93V11h3.93A7.006 7.006 0 0 0 13 7.07Z"/>
                    </svg>
                    Powered by <span class="underline decoration-dotted">AgenticLearnPro</span>
                </a>
            </div>
        </div>
    </footer>
</div>
@endsection
