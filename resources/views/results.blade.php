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
@endsection