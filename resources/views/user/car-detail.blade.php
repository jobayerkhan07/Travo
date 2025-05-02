{{-- resources/views/user/car-detail.blade.php --}}
@extends('layouts.customerlayout')

@section('title', $car->car_model.' Details')

@section('content')
    <div class="container">
        <div class="detail-wrapper">

            {{-- Image slider (simple) --}}
            <div class="detail-gallery">
                @foreach($car->images as $img)
                    <img src="{{ asset('storage/'.$img) }}" alt="car" class="gallery-img">
                @endforeach
            </div>

            {{-- Info card --}}
            <div class="detail-info">
                <h1 class="detail-title">{{ strtoupper($car->car_model) }}</h1>

                <ul class="detail-list">
                    <li><strong>Passenger Capacity:</strong> {{ $car->capacity }}</li>
                    <li><strong>Colour:</strong> {{ $car->car_color ?? 'N/A' }}</li>
                    <li><strong>Plate:</strong> {{ $car->plate_number }}</li>
                    <li><strong>AC:</strong> {{ $car->air_conditioning ? 'Yes' : 'No' }}</li>
                    <li><strong>Owner:</strong> {{ $car->owner_name }} ({{ $car->owner_phone }})</li>
                </ul>

                <p class="price-big">
                    {{ number_format($car->price_per_day,0) }} Tk / day
                </p>

                <a href="{{ route('user.checkout', ['id' => $car->id]) }}">
                    <button class="list-service">Proceed to Book</button>
                </a>
            </div>

        </div>
    </div>
@endsection
