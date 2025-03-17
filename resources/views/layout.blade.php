<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function toggleSidebar() {
            document.getElementById("sidebar").classList.toggle("-translate-x-full");
        }
    </script>
</head>
<body class="bg-gray-200 flex min-h-screen">
    
    <!-- Sidebar -->
    <div id="sidebar" class="fixed inset-y-0 left-0 bg-gradient-to-b from-blue-900 to-blue-700 text-white w-64 transform -translate-x-full transition-transform lg:translate-x-0 shadow-lg">
        <div class="p-5 flex flex-col items-center border-b border-gray-500">
            
            <!-- Logo at the Top -->
            <img src="{{ asset('TPLnew1.png') }}" alt="Weather Logo" class="w-30 h-20 mb-2">

            <!-- App Title -->
            <h2 class="text-xl font-semibold">🌤️ Weather App</h2>

            <button onclick="toggleSidebar()" class="lg:hidden focus:outline-none text-white text-xl absolute top-5 right-5">✖</button>
        </div>

        <nav class="mt-4">
            <a href="/" class="block py-3 px-6 hover:bg-blue-600 transition-all duration-300 border-b border-gray-500">🏠 Home</a>
            <a href="/forecast" class="block py-3 px-6 hover:bg-blue-600 transition-all duration-300 border-b border-gray-500">📅 Forecast</a>
            <a href="/about" class="block py-3 px-6 hover:bg-blue-600 transition-all duration-300 border-b border-gray-500">ℹ️ About Us</a>
            <a href="/settings" class="block py-3 px-6 hover:bg-blue-600 transition-all duration-300">📩 Contact</a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col lg:ml-64">
        <nav class="w-full bg-blue-700 p-4 text-white flex items-center justify-between shadow-md">
            <button onclick="toggleSidebar()" class="lg:hidden text-white text-2xl focus:outline-none">☰</button>
            <h1 class="text-2xl font-bold mx-auto">Weather Dashboard</h1>
        </nav>

        <div class="p-6">
            @yield('content')
        </div>
    </div>

</body>
</html>
