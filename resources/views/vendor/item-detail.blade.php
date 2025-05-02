<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Detail</title>
    <link rel="stylesheet" href="{{ asset('css/vendorCSS.css') }}">
</head>
<body>

@include('layouts.vendorlayout')

<div class="container" style="max-width: 1100px; margin: auto; padding: 30px 20px;">

    <h1 style="font-size: 28px; font-weight: bold; text-align: center; color: #014201; margin-bottom: 30px;">
        {{ ucfirst($type) }} Details
    </h1>

    <div style="background: #fff; border-radius: 12px; box-shadow: 0 6px 12px rgba(0,0,0,0.1); padding: 30px;">

        {{-- Images --}}
        @php
            $images = $type == 'room' ? (is_string($item->room_images) ? json_decode($item->room_images, true) : $item->room_images) : $item->images;
        @endphp

        @if(!empty($images) && is_array($images))
            <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 15px; margin-bottom: 30px;">
                @foreach($images as $img)
                    <img src="{{ asset('storage/' . $img) }}"
                         class="small-thumb"
                         onclick="openLightbox('{{ asset('storage/' . $img) }}')"
                         alt="Item Image">
                @endforeach
            </div>
        @else
            <p style="text-align: center; color: gray;">No Images Uploaded</p>
        @endif

        {{-- Item Details --}}
        <div style="max-width: 600px; margin: auto; font-size: 16px; line-height: 1.8;">
            @if($type == 'property')
                <p><strong>Name:</strong> {{ $item->property_name }}</p>
                <p><strong>Type:</strong> {{ $item->property_type }}</p>
                <p><strong>Location:</strong> {{ $item->location }}</p>
                <p><strong>Guests:</strong> {{ $item->guests }}</p>
                <p><strong>Bathrooms:</strong> {{ $item->bathrooms }}</p>
                <p><strong>Price Per Day:</strong> {{ number_format($item->price_per_day, 2)}} BDT</p>
                <p><strong>Status:</strong> {{ ucfirst($item->status) }}</p>
            @elseif($type == 'car')
                <p><strong>Model:</strong> {{ $item->car_model }}</p>
                <p><strong>Capacity:</strong> {{ $item->capacity }}</p>
                <p><strong>Color:</strong> {{ $item->color }}</p>
                <p><strong>Plate Number:</strong> {{ $item->plate_number }}</p>
                <p><strong>Price Per Day:</strong> {{ number_format($item->price_per_day, 2) }} BDT</p>
                <p><strong>Air Conditioning:</strong> {{ $item->air_conditioning ? 'Yes' : 'No' }}</p>
                <p><strong>Status:</strong> {{ ucfirst($item->status) }}</p>
            @elseif($type == 'room')
                <p><strong>Name:</strong> {{ $item->property_name }}</p>
                <p><strong>Room Number:</strong> {{ $item->room_number }}</p>
                <p><strong>Type:</strong> {{ $item->room_type }}</p>
                <p><strong>Number of Beds:</strong> {{ $item->num_beds }}</p>
                <p><strong>Location:</strong> {{ $item->location }}</p>
                <p><strong>Max Capacity:</strong> {{ $item->max_capacity }}</p>
                <p><strong>Floor:</strong> {{ $item->floor_number }}</p>
                <p><strong>Room Size:</strong> {{ $item->room_size }} sq meters</p>
                <p><strong>Price Per Night:</strong> {{ number_format($item->price_per_night, 2) }} BDT</p>
                <p><strong>Status:</strong> {{ ucfirst($item->status) }}</p>
            @endif
        </div>

    </div>
</div>

{{-- Lightbox Modal --}}
<div id="lightboxModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.8); z-index: 9999; justify-content: center; align-items: center;">
    <span id="lightboxClose" style="position: absolute; top: 20px; right: 30px; font-size: 30px; color: white; cursor: pointer;">&times;</span>
    <img id="lightboxImage" src="" style="max-width:90%; max-height:90%; border-radius: 10px;">
</div>

<script>
    function openLightbox(src) {
        const modal = document.getElementById('lightboxModal');
        const image = document.getElementById('lightboxImage');
        modal.style.display = 'flex';
        image.src = src;
    }

    function closeLightbox() {
        document.getElementById('lightboxModal').style.display = 'none';
    }

    document.getElementById('lightboxModal').addEventListener('click', function(event) {
        if (event.target.id === 'lightboxModal' || event.target.id === 'lightboxClose') {
            closeLightbox();
        }
    });

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeLightbox();
        }
    });
</script>

<style>
    .small-thumb {
        width: 200px;
        height: 200px;
        object-fit: contain;
        border-radius: 10px;
        background: #f0f0f0;
        padding: 5px;
        cursor: pointer;
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }
    .small-thumb:hover {
        transform: scale(1.08);
        box-shadow: 0 6px 12px rgba(0,0,0,0.3);
    }
</style>

</body>
</html>
