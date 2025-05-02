<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Overview</title>
    <script src="https://cdn.tailwindcss.com"></script> <!-- TailwindCSS -->
</head>
<body >
@include('layouts.vendorlayout')

<div class="container mx-auto px-4 py-10">
    <h1 class="text-3xl font-bold text-green-900 text-center mb-10">Your Listings</h1>

    <div class="flex flex-wrap justify-center gap-8">

        {{-- Properties --}}
        @foreach($properties as $property)
            <div class="bg-white shadow-lg rounded-lg overflow-hidden w-64">
                <img class="h-40 w-full object-cover" src="{{ asset('storage/' . ($property->images[0] ?? 'default.jpg')) }}" alt="Property Image">
                <div class="p-5 text-center">
                    <h3 class="text-xl font-bold text-green-900 mb-2">{{ $property->property_name }}</h3>
                    <p class="text-gray-600 text-sm"><strong>Location:</strong> {{ $property->location }}</p>
                    <p class="text-gray-600 text-sm"><strong>Price:</strong> {{ number_format($property->price_per_day, 2) }} BDT</p>
                    <a href="{{ route('vendor.itemDetail', ['type' => 'property', 'id' => $property->id]) }}"
                       class="mt-4 inline-block bg-green-900 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        View Details
                    </a>
                </div>
            </div>
        @endforeach

        {{-- Cars --}}
        @foreach($cars as $car)
            <div class="bg-white shadow-lg rounded-lg overflow-hidden w-64">
                <img class="h-40 w-full object-cover" src="{{ asset('storage/' . ($car->images[0] ?? 'default.jpg')) }}" alt="Car Image">
                <div class="p-5 text-center">
                    <h3 class="text-xl font-bold text-green-900 mb-2">{{ $car->car_model }}</h3>
                    <p class="text-gray-600 text-sm"><strong>Plate:</strong> {{ $car->car_plate_number }}</p>
                    <p class="text-gray-600 text-sm"><strong>Price/Day:</strong> {{ number_format($car->price_per_day, 2) }} BDT</p>
                    <a href="{{ route('vendor.itemDetail', ['type' => 'car', 'id' => $car->id]) }}"
                       class="mt-4 inline-block bg-green-900 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        View Details
                    </a>
                </div>
            </div>
        @endforeach

        {{-- Rooms --}}
        {{-- Rooms --}}
        @foreach($rooms as $room)
            @php
                $images = is_string($room->room_images) ? json_decode($room->room_images, true) : $room->room_images;
            @endphp
            <div class="bg-white shadow-lg rounded-lg overflow-hidden w-64">
                <img class="h-40 w-full object-cover" src="{{ asset('storage/' . ($images[0] ?? 'default.jpg')) }}" alt="Room Image">
                <div class="p-5 text-center">
                    <h3 class="text-xl font-bold text-green-900 mb-2">Room {{ $room->room_number }}</h3>
                    <p class="text-gray-600 text-sm"><strong>Floor:</strong> {{ $room->floor_number }}</p>
                    <p class="text-gray-600 text-sm"><strong>Price/Night:</strong> {{ number_format($room->price_per_night, 2) }} BDT</p>
                    <a href="{{ route('vendor.itemDetail', ['type' => 'room', 'id' => $room->id]) }}"
                       class="mt-4 inline-block bg-green-900 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        View Details
                    </a>
                </div>
            </div>
        @endforeach


    </div>

</div>

</body>
</html>
