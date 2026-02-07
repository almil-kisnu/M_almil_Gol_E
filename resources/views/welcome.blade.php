<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <script src="https://cdn.tailwindcss.com"></script>
        @endif
    </head>
    <body class="bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-900 dark:to-gray-800 text-gray-800 dark:text-gray-200 flex items-center justify-center min-h-screen font-sans">
        <div class="text-center p-10 bg-white dark:bg-gray-800 rounded-2xl shadow-2xl transform hover:scale-105 transition duration-500 ease-in-out max-w-2xl w-full border border-gray-100 dark:border-gray-700">
            <h1 class="text-4xl md:text-6xl font-extrabold mb-6 bg-clip-text text-transparent bg-gradient-to-r from-blue-500 to-purple-600 animate-pulse">
                Welcome
            </h1>
            <p class="text-xl md:text-2xl font-medium mb-8 text-gray-600 dark:text-gray-300">
                Mohammad Almil Hisullah Gol E
            </p>
            <a href="{{ url('/dashboard') }}" class="inline-block bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-bold py-3 px-8 rounded-full shadow-lg transform hover:-translate-y-1 transition duration-300 ease-in-out text-lg">
                Go to Dashboard
            </a>
        </div>
    </body>
</html>
