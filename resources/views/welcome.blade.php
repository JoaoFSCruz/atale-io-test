@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('get-family-count') }}" class="w-3/4 flex flex-col pb-12 lg:w-1/2">
        @csrf
        <h1 class="text-3xl md:text-4xl">
            Find out your <span class="text-yellow-400">ascendants</span> and <span class="text-yellow-400">descendants</span>
        </h1>

        <p class="text-gray-400 text-xl mt-4 md:text-2xl">By introducing your email, we will check our records to fetch your family count.</p>

        <div class="flex flex-col mt-4 md:mt-12">
            <div class="flex items-center">
                <label class="text-xl tracking-wide" for="email">Email</label>
                <span class="ml-8 text-red-600">
                    @error('email')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <input
                    class="rounded-lg mt-2 px-6 py-4 text-2xl text-gray-900 bg-gray-50 border border-gray-800"
                    type="text"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
            >
        </div>

        <button class="px-6 py-4 bg-yellow-400 text-gray-800 uppercase text-lg rounded-lg mt-8 font-semibold hover:bg-yellow-500 md:text-2xl md:mt-12">
            Get Family Count
        </button>

        <div class="flex justify-center">
            <p class="text-xl md:text-2xl mt-12 text-gray-600">
                Don't have a record yet?
                <a class="text-yellow-400 underline cursor-pointer hover:text-yellow-500" href="{{ route('users.create') }}">Create one!</a>
            </p>
        </div>
    </form>
@endsection