<!-- Sidebar Component -->
<div id="sidebar" class="fixed inset-y-0 left-0 bg-blue-700 text-white w-64 transform -translate-x-full transition-transform lg:translate-x-0 shadow-lg">
    <div class="p-5 flex justify-between items-center">
        <h2 class="text-xl font-semibold">Weather App</h2>
        <button onclick="toggleSidebar()" class="lg:hidden focus:outline-none text-white text-xl">✖</button>
    </div>
    <nav class="mt-4">
        <a href="/" class="block py-2 px-4 hover:bg-blue-600">🏠 Home</a>
        <a href="/forecast" class="block py-2 px-4 hover:bg-blue-600">🌤️ Forecast</a>
        <a href="/about" class="block py-2 px-4 hover:bg-blue-600">ℹ️ About Us</a>
        <a href="/contact" class="block py-2 px-4 hover:bg-blue-600">📩 Contact</a> <!-- Updated Contact Icon -->
    </nav>
</div>
