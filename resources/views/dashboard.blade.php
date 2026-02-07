<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 min-h-screen flex flex-col font-sans antialiased">
    <nav class="bg-white dark:bg-gray-800 shadow p-4 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold text-indigo-600 dark:text-indigo-400">My Dashboard</h1>
            <a href="{{ url('/') }}" class="text-sm text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 transition duration-150 ease-in-out">
                &larr; Back to Home
            </a>
        </div>
    </nav>
    <main class="flex-grow p-6">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Card 1 -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow hover:shadow-lg transition-shadow duration-300 border border-gray-100 dark:border-gray-700">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Statistics</h2>
                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Up 12%</span>
                </div>
                <p class="text-gray-600 dark:text-gray-400">View your latest stats and performance metrics here.</p>
                <div class="mt-4">
                     <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                        <div class="bg-blue-600 h-2.5 rounded-full" style="width: 45%"></div>
                    </div>
                    <span class="text-xs text-gray-500 mt-1 block">45% Complete</span>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow hover:shadow-lg transition-shadow duration-300 border border-gray-100 dark:border-gray-700">
                <h2 class="text-lg font-semibold mb-2 text-gray-900 dark:text-white">Reports</h2>
                <p class="text-gray-600 dark:text-gray-400 mb-4">Download your monthly reports and analyze data trends.</p>
                <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded w-full transition duration-150">
                    Download PDF
                </button>
            </div>
            <!-- Card 3 -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow hover:shadow-lg transition-shadow duration-300 border border-gray-100 dark:border-gray-700">
                <h2 class="text-lg font-semibold mb-2 text-gray-900 dark:text-white">Settings</h2>
                <p class="text-gray-600 dark:text-gray-400 mb-4">Manage your account settings and preferences.</p>
                <button class="border border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 font-bold py-2 px-4 rounded w-full transition duration-150">
                    Manage Account
                </button>
            </div>
        </div>
    </main>
    <footer class="bg-white dark:bg-gray-800 p-6 border-t border-gray-200 dark:border-gray-700 text-center text-sm text-gray-500">
        &copy; {{ date('Y') }} Mohammad Almil Hisullah Gol E. All rights reserved.
    </footer>
</body>
</html>
