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
    </head>
    <body class="antialiased bg-gray-50 h-screen">
        <div class="bg-gray-800">
            <div class="container mx-auto py-4">
                <h1 class="text-4xl text-gray-50">
                    atale<span class="text-yellow-400">.io</span> Test
                </h1>
            </div>
        </div>

        <div class="container mx-auto mt-32 flex justify-center">
            <div class="flex flex-col bg-gray-800 text-gray-50 rounded-lg p-12">
                <h1 class="text-3xl">
                    Find out your <span class="text-yellow-400">ascendants</span> and <span class="text-yellow-400">descendants</span>.
                </h1>

                <div class="flex flex-col mt-8">
                    <label class="text-xl tracking-wide" for="email">Email</label>
                    <input class="rounded-lg mt-2 px-6 py-4 text-2xl text-gray-900 bg-gray-50" type="text" id="email" name="email">
                </div>

                <div class="flex flex-col mt-8">
                    <label class="text-xl tracking-wide" for="parents">Choose Parents</label>
                    <input class="rounded-lg mt-2 px-6 py-4 text-2xl text-gray-900 bg-gray-50" type="search" id="parents" name="parents">
                </div>

                <div class="flex flex-col mt-8">
                    <label class="text-xl tracking-wide" for="children">Choose Children</label>
                    <input class="rounded-lg mt-2 px-6 py-4 text-2xl text-gray-900 bg-gray-50" type="search" id="children" name="children">
                </div>

                <button class="px-6 py-4 bg-yellow-400 text-gray-800 uppercase text-2xl rounded-lg mt-12 font-semibold hover:bg-yellow-500">Submit</button>
            </div>
        </div>
    </body>
</html>
