@extends('layouts.customerlayout')


@section('title', 'Explore Hotels')

@section('content')

<!-- Hotel Listings -->
<!-- option box -->
<div class="container">
    <h1 style="font-size: 2.5rem; margin-bottom: 10px;">Book your hotel</h1>


    <div class="box-container">
        @foreach($rooms as $room)
            <div class="box">
                <div class="hotel-card">
                    @php
                        $images = [];
                        if (!empty($room->room_images)) {
                            $images = is_array($room->room_images)
                                ? $room->room_images
                                : json_decode($room->room_images, true);
                        }
                    @endphp

                    @if(!empty($images))
                        <img src="{{ asset('storage/' . $images[0]) }}" alt="Room Image">
                    @else
                        <p style="text-align: center; color: gray;">No Room Images Uploaded</p>
                    @endif
                </div>
                <h2 style="font-size: 1.5rem; margin-bottom: 10px;">{{ $room->property_name }}</h2>
                <p style="font-size: 1rem; color: #5d5252; margin-bottom: 15px;">{{ $room->location }}</p>
                <p style="font-size: 1rem; color: #5d5252; margin-bottom: 10px;">Room No: {{ $room->room_number }} | Floor: {{ $room->floor_number }}</p>
                <p style="font-size: 1rem; color: #5d5252; margin-bottom: 10px;">Size: {{ $room->room_size }} sq mtr | Type: {{ $room->room_type }}</p>
                <p style="font-size: 1rem; color: #5d5252; margin-bottom: 10px;">Beds: {{ $room->num_beds }} | Max Guests: {{ $room->max_capacity }}</p>

                <p style="font-size: 0.9rem; color: #5d5252; margin-bottom: 10px;">
                    Amenities:
                    @if($room->air_conditioning) AC @endif
                    @if($room->wifi) | WiFi @endif
                    @if($room->balcony) | Balcony @endif
                </p>

                @if($room->extra_guest_price)
                    <p style="font-size: 0.7rem; color: #aa0000; margin-bottom: 10px;">
                        Extra Guest Charge: {{ $room->extra_guest_price }} tk
                    </p>
                @endif
                <p style="font-size: 0.9rem; color: green; margin-bottom: 20px;">Price per Night {{ $room->price_per_night }} tk</p>

                <a href="{{ route('user.checkout', ['type'=>'room','id' => $room->id]) }}" class="list-service" style="display: inline-block; padding: 10px 20px; background: #014201; color: white; text-align: center; border-radius: 8px;">
                    Process to book
                </a>


            </div>
        @endforeach
    </div>

@endsection
