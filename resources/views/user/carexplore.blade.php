{{-- resources/views/user/carexplore.blade.php --}}
@extends('layouts.customerlayout')

@section('title','Explore Cars')

@section('content')
    <div class="container">
        <h1 class="title">Book Your Transport With Us</h1>

        <div class="box-container">
            @forelse ($cars as $car)
                <div class="box">
                    <div class="hotel-card">
                        {{-- first image or placeholder --}}
                        @php $pic = $car->images[0] ?? null; @endphp
                        <img src="{{ $pic ? asset('storage/'.$pic) : asset('images/no-img.jpg') }}" alt="car">
                    </div>

                    <h2 style="font-size: 1.5rem; margin-bottom: 10px;">
                        {{ strtoupper($car->car_model) }}
                    </h2>

                    <p style="font-size: 1rem; color: #5d5252; margin-bottom: 15px;">
                        Seats&nbsp;{{ $car->capacity }}
                    </p>

                    <p style="font-size: 1rem; color: #5d5252; margin-bottom: 10px;">
                        Colour:&nbsp;{{ $car->car_color ?? '—' }}
                        &nbsp;|&nbsp; Plate:&nbsp;{{ $car->plate_number }}
                    </p>

                    <p style="font-size: 1rem; color: #5d5252; margin-bottom: 10px;">
                        Air&nbsp;Conditioning:&nbsp;{{ $car->air_conditioning ? 'Yes' : 'No' }}
                    </p>

                    <p style="font-size: 0.9rem; color: #5d5252; margin-bottom: 10px;">
                        Owner: {{ $car->owner_name }}&nbsp;({{ $car->owner_phone }})
                    </p>

                    <p style="font-size: 0.9rem; color: green; margin-bottom: 20px;">
                        Price&nbsp;per&nbsp;Day&nbsp;{{ number_format($car->price_per_day, 0) }}&nbsp;tk
                    </p>
                    <a href="{{ route('user.checkout', ['type'=>'car', 'id'=>$car->id]) }}">
                        <button class="list-service">Process to Book</button>
                    </a>
                </div>
            @empty
                <p>No cars available.</p>
            @endforelse
        </div>

        {{-- pagination --}}
        <div style="margin-top:2rem;">
            {{ $cars->links() }}
        </div>
    </div>
@endsection
