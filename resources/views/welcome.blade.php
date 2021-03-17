<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>atale.io Test</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
            body {
                font-family: 'Work Sans', sans-serif;
            }
        </style>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="antialiased bg-gray-50 h-screen text-gray-900" id="app">
        <div class="bg-gray-800">
            <div class="container mx-auto py-4">
                <h1 class="text-4xl text-gray-50">
                    atale<span class="text-yellow-400">.io</span>
                    <span class="text-base"> Code Test</span>
                </h1>
            </div>
        </div>

        <div class="container mx-auto mt-32">
            <main-form></main-form>
        </div>
    </body>
</html>