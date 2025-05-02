@extends('layouts.adminlayout')

@section('content')
    <div class="container" style="max-width: 1000px; margin: auto; padding: 30px;">

        <h1 style="font-size: 30px; font-weight: bold; text-align: center; color: #014201; margin-bottom: 20px;">
            Room Details
        </h1>

        <div style="background: #fff; border-radius: 12px; box-shadow: 0 6px 12px rgba(0,0,0,0.1); padding: 30px;">

            {{-- Room Name --}}
            <h2 style="text-align: center; color: #014201; font-size: 26px; margin-bottom: 20px;">
                Room: {{ $room->room_number }}
            </h2>

            {{-- Room Images --}}
            @if(!empty($room->room_images))
                @php
                    $images = is_string($room->room_images) ? json_decode($room->room_images, true) : $room->room_images;
                @endphp

                <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 15px; margin-bottom: 30px;">
                    @foreach($images as $img)
                        <img src="{{ asset('storage/' . $img) }}"
                             class="small-thumb"
                             onclick="openLightbox('{{ asset('storage/' . $img) }}')"
                             alt="Room Image">
                    @endforeach
                </div>
            @else
                <p style="text-align: center; color: gray;">No Room Images Uploaded</p>
            @endif


            {{-- Room Information --}}
            <div style="max-width: 600px; margin: auto; font-size: 16px; line-height: 1.8;">

                <p><strong>Owner:</strong> {{ $room->vendor->firstname ?? 'Unknown' }} {{ $room->vendor->lastname ?? '' }}</p>
                <p><strong>Floor Number:</strong> {{ $room->floor_number }}</p>
                <p><strong>Room Size:</strong> {{ $room->room_size }} sq meters</p>
                <p><strong>Room Type:</strong> {{ $room->room_type }}</p>
                <p><strong>Number of Beds:</strong> {{ $room->num_beds }}</p>
                <p><strong>Max Capacity:</strong> {{ $room->max_capacity }} People</p>
                <p><strong>Air Conditioning:</strong> {{ $room->air_conditioning ? 'Yes' : 'No' }}</p>
                <p><strong>WiFi Available:</strong> {{ $room->wifi ? 'Yes' : 'No' }}</p>
                <p><strong>Balcony Available:</strong> {{ $room->balcony ? 'Yes' : 'No' }}</p>
                <p><strong>Price per Night:</strong> ${{ number_format($room->price_per_night, 2) }}</p>
                <p><strong>Extra Guest Price:</strong> ${{ number_format($room->extra_guest_price, 2) }}</p>

                <p><strong>Availability:</strong> {{ \Carbon\Carbon::parse($room->available_from)->format('d M Y') }} to {{ \Carbon\Carbon::parse($room->available_to)->format('d M Y') }}</p>

                <p><strong>Status:</strong>
                    <span style="color: {{ $room->status == 'Approved' ? 'green' : ($room->status == 'Rejected' ? 'red' : 'orange') }};">
                    {{ ucfirst($room->status) }}
                </span>
                </p>

                {{-- Approve / Reject buttons --}}
                <div style="margin-top: 20px; text-align: center;">
                    <form action="{{ route('admin.room.approve', $room->id) }}" method="POST" style="display: inline;">
                        @csrf
                        <button style="background: #28a745; color: white; border: none; padding: 8px 16px; border-radius: 8px; font-size: 16px; cursor: pointer; margin-right: 10px;">
                            <i class="uil uil-check"></i> Approve
                        </button>
                    </form>

                    <form action="{{ route('admin.room.reject', $room->id) }}" method="POST" style="display: inline;">
                        @csrf
                        <button style="background: #dc3545; color: white; border: none; padding: 8px 16px; border-radius: 8px; font-size: 16px; cursor: pointer;">
                            <i class="uil uil-times"></i> Reject
                        </button>
                    </form>
                </div>

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
@endsection
