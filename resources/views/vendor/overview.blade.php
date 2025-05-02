<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRAVO | BUSINESS PARTNER</title>
    <link rel="stylesheet" href="{{ asset('css/vendorCSS.css') }}">
</head>
<body>

@include('layouts.vendorlayout')

<div class="container" style="max-width: 1100px; margin: auto; padding: 30px 20px;">

    <h1 style="font-size: 30px; font-weight: bold; text-align: center; margin-bottom: 30px; color: #014201;">
        Vendor Business Details
    </h1>

    @if(session('success'))
        <div style="color: green; text-align: center; margin-bottom: 20px; font-weight: bold;">
            {{ session('success') }}
        </div>
    @endif

    @if($property)
        <div style="background: #fff; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); padding: 20px;">

            {{-- Images --}}
            <div style="display: flex; flex-wrap: wrap; gap: 20px; justify-content: center; margin-bottom: 30px;">
                @foreach($property->images as $img)
                    <img src="{{ asset('storage/' . $img) }}"
                         alt="Property Image"
                         class="small-thumb"
                         onclick="openLightbox('{{ asset('storage/' . $img) }}')">
                @endforeach
            </div>

            {{-- Property Summary --}}
            <div style="max-width: 600px; margin: auto; text-align: left;">
                <h2 style="color: #014201; font-size: 24px; text-align: center; margin-bottom: 20px;">Property Summary</h2>

                <div style="display: grid; grid-template-columns: 150px auto; row-gap: 10px; font-size: 16px;">

                    <div><strong>Property Name:</strong></div> <div>{{ $property->property_name }}</div>
                    <div><strong>Type:</strong></div> <div>{{ $property->property_type }}</div>
                    <div><strong>Location:</strong></div> <div>{{ $property->location }}</div>
                    <div><strong>Address:</strong></div> <div>{{ $property->address }}</div>
                    <div><strong>Guests:</strong></div> <div>{{ $property->guests }}</div>
                    <div><strong>Bathrooms:</strong></div> <div>{{ $property->bathrooms }}</div>
                    <div><strong>Children Allowed:</strong></div> <div>{{ $property->children_allowed ? 'Yes' : 'No' }}</div>
                    <div><strong>Max Children:</strong></div> <div>{{ $property->children_no }}</div>
                    <div><strong>Pets Allowed:</strong></div> <div>{{ $property->pets_allowed ? 'Yes' : 'No' }}</div>
                    <div><strong>Max Pets:</strong></div> <div>{{ $property->pets_no }}</div>
                    <div><strong>Room Size:</strong></div> <div>{{ $property->room_size }}</div>
                    <div><strong>Price Per Day:</strong></div> <div>${{ number_format($property->price_per_day, 2) }}</div>
                    <div><strong>Check-In:</strong></div> <div>{{ $property->check_in_time }}</div>
                    <div><strong>Check-Out:</strong></div> <div>{{ $property->check_out_time }}</div>

                </div>
            </div>

        </div>
    @else
        <p style="text-align: center; color: red;">No property found. Please add one!</p>
    @endif

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

    // Click outside image or on (X) to close
    document.getElementById('lightboxModal').addEventListener('click', function(event) {
        if (event.target.id === 'lightboxModal' || event.target.id === 'lightboxClose') {
            closeLightbox();
        }
    });

    // Press ESC key to close
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeLightbox();
        }
    });
</script>

<style>
    .small-thumb {
        width: 250px;
        height: 200px;
        object-fit: contain;
        border-radius: 8px;
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
