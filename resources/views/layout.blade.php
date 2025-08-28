<!DOCTYPE html>
<html lang="en" class="scroll-smooth antialiased">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Weather App')</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      // Tailwind dark mode via class
      tailwind.config = {
        darkMode: 'class',
        theme: {
          extend: {
            boxShadow: {
              'soft': '0 10px 25px -10px rgba(0,0,0,0.25)',
            }
          }
        }
      };
    </script>

    <script>
      // Theme & sidebar logic
      (function () {
        const html = document.documentElement;
        const saved = localStorage.getItem('theme');
        if (saved === 'dark' || (!saved && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
          html.classList.add('dark');
        }

        window.toggleTheme = () => {
          html.classList.toggle('dark');
          localStorage.setItem('theme', html.classList.contains('dark') ? 'dark' : 'light');
        };

        window.toggleSidebar = () => {
          document.getElementById('sidebar').classList.toggle('-translate-x-full');
          document.getElementById('backdrop').classList.toggle('hidden');
          document.getElementById('backdrop').classList.toggle('opacity-0');
        };

        window.closeSidebar = () => {
          document.getElementById('sidebar').classList.add('-translate-x-full');
          document.getElementById('backdrop').classList.add('hidden');
        };
      })();
    </script>
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-100 min-h-screen flex">
  <!-- Mobile Backdrop -->
  <div id="backdrop"
       class="fixed inset-0 z-30 hidden bg-black/40 backdrop-blur-sm transition duration-200 opacity-100 lg:hidden"
       onclick="closeSidebar()"></div>

  <!-- Sidebar -->
  <aside id="sidebar"
         class="fixed z-40 inset-y-0 left-0 w-72 transform -translate-x-full transition-transform duration-300 lg:translate-x-0
                bg-gradient-to-b from-blue-900 to-blue-700 text-white shadow-2xl">
    <div class="p-6 border-b border-white/20 relative">
      <!-- Logo + Title -->
      <div class="flex items-center gap-3">
        <img src="{{ asset('TPLnew1.png') }}" alt="Weather Logo"
             class="h-12 w-auto rounded-md ring-1 ring-white/20 shadow-soft" />
        <div>
          <h2 class="text-xl font-bold tracking-tight">🌤️ Weather App</h2>
          <p class="text-xs text-white/70">Your daily forecast hub</p>
        </div>
      </div>

      <!-- Close (mobile) -->
      <button onclick="toggleSidebar()"
              class="lg:hidden absolute top-5 right-5 text-white/80 hover:text-white focus:outline-none"
              aria-label="Close sidebar">✖</button>
    </div>

    <nav class="mt-4 px-3 pb-6 space-y-1">
      @php
        $link = fn($path) => request()->is(trim($path,'/')) ? 'bg-white/15 text-white shadow-inner' : 'hover:bg-white/10 text-white/90';
      @endphp

      <a href="/" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ $link('/') }}">
        <span>🏠</span><span class="font-medium">Home</span>
      </a>
      <a href="/forecast" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ $link('/forecast') }}">
        <span>📅</span><span class="font-medium">Forecast</span>
      </a>
      <a href="/about" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ $link('/about') }}">
        <span>ℹ️</span><span class="font-medium">About Us</span>
      </a>
      <a href="/settings" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ $link('/settings') }}">
        <span>📩</span><span class="font-medium">Contact</span>
      </a>

      <!-- Mini Callout -->
      <div class="mt-4 rounded-xl border border-white/20 p-4 bg-white/5">
        <p class="text-sm leading-snug">
          Tip: Toggle <span class="font-semibold">dark mode</span> from the header 🌙
        </p>
      </div>
    </nav>

    <!-- Sidebar Footer -->
    <div class="mt-auto px-6 py-4 border-t border-white/20 text-sm text-white/80">
      <p>© <span class="font-semibold">Weather App</span> — {{ date('Y') }}</p>
    </div>
  </aside>

  <!-- Main column -->
  <div class="flex-1 flex flex-col lg:ml-72">
    <!-- Top Nav -->
    <header class="w-full sticky top-0 z-20 bg-white/80 dark:bg-gray-950/70 backdrop-blur border-b border-gray-200/70 dark:border-gray-800">
      <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="h-16 flex items-center justify-between gap-3">
          <div class="flex items-center gap-2">
            <button onclick="toggleSidebar()" class="lg:hidden text-gray-700 dark:text-gray-200 text-2xl p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800" aria-label="Open sidebar">☰</button>
            <h1 class="text-xl sm:text-2xl font-extrabold tracking-tight bg-clip-text text-transparent
                       bg-gradient-to-r from-blue-600 to-indigo-600 dark:from-blue-400 dark:to-indigo-400">
              Weather Dashboard
            </h1>
          </div>

          <div class="flex items-center gap-2">
            <!-- Theme toggle -->
            <button onclick="toggleTheme()"
                    class="px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-800 hover:bg-gray-100 dark:hover:bg-gray-800 text-sm font-medium">
              <span class="hidden sm:inline">Toggle</span> 🌙
            </button>

            <!-- CTA (optional) -->
            <a href="/forecast"
               class="hidden sm:inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 shadow-soft text-sm font-semibold">
              View Forecast
            </a>
          </div>
        </div>
      </div>
    </header>

    <!-- Page content -->
    <main class="flex-1">
      <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        <!-- Card wrapper for pages that don't supply their own container -->
        <div class="rounded-2xl bg-white dark:bg-gray-950 border border-gray-200 dark:border-gray-800 shadow-soft">
          <div class="p-5 sm:p-7">
            @yield('content')
          </div>
        </div>

   