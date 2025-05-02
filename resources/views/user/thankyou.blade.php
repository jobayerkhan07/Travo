{{-- resources/views/user/thankyou.blade.php --}}
@extends('layouts.customerlayout')

@section('title', 'Thank-you')

@section('content')
    <div class="max-w-2xl mx-auto mt-12 p-8 bg-white shadow-lg rounded-lg text-center">
        {{-- Big heading --}}
        <h1 class="text-4xl font-bold text-green-800 mb-2">Thank You!</h1>

        {{-- Sub-heading --}}
        <p class="text-gray-700 mb-6">
            @if(session('success'))
                {{ session('success') }}
            @elseif(session('fail'))
                {{ session('fail') }}
            @else
                Your action has been processed.
            @endif
        </p>

        {{-- Icon --}}
        <svg xmlns="http://www.w3.org/2000/svg"
             class="h-24 w-24 mx-auto text-green-600 mb-6"
             viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
                  d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.707a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 10-1.414 1.414L9 13.414l4.707-4.707z"
                  clip-rule="evenodd" />
        </svg>

        {{-- “Go home / see bookings” button --}}
        <a href="{{ route('home') }}"
           class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-md shadow">
            Back to Home
        </a>
    </div>
@endsection
