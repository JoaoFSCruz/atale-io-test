@extends('layouts.app')

@section('content')
    <h1 class="text-3xl md:text-4xl">
        Here you go! Your <span class="text-yellow-400">ascendants</span> and <span class="text-yellow-400">descendants</span>
    </h1>

    <div class="flex space-x-24 justify-center mt-12">
        <div class="flex flex-col items-center">
            <p class="text-5xl rounded-lg font-semibold">
                {{ $ascendants }}
            </p>
            <p class="text-3xl mt-4">Ascendants</p>
        </div>
        <div class="flex flex-col items-center">
            <p class="text-5xl rounded-lg font-semibold">
                {{ $descendants }}
            </p>
            <p class="text-3xl mt-4">Descendants</p>
        </div>
    </div>

    <a class="px-6 py-4 bg-gray-600 text-gray-50 uppercase text-lg rounded-lg mt-8 font-semibold hover:bg-gray-800 md:text-2xl md:mt-12" href="{{ route('welcome') }}">
        Back
    </a>
@endsection