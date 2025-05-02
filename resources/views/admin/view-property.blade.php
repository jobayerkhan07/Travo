@extends('layouts.adminlayout')

@section('content')
    <div class="container" style="max-width: 1000px; margin: auto; padding: 30px;">

        <h1 style="font-size: 30px; font-weight: bold; text-align: center; color: #014201; margin-bottom: 20px;">
            Property Details
        </h1>

        <div style="background: #fff; border-radius: 12px; box-shadow: 0 6px 12px rgba(0,0,0,0.1); padding: 30px;">

            {{-- Property Name --}}
            <h2 style="text-align: center; color: #014201; font-size: 26px; margin-bottom: 20px;">
                {{ $property->property_name }}
            </h2>

            {{-- Property Images --}}
            @if(is_array($property->images) && count($property->images) > 0)
                <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 15px; margin-bottom: 30px;">
                    @foreach($property->images as $img)
                        <img src="{{ asset('storage/' . $img) }}"
                             class="small-thumb"
                             onclick="openLightbox('{{ asset('storage/' . $img) }}')"
                             alt="Property Image">
                    @endforeach
                </div>
            @else
                <p style="text-align: center; color: gray;">No Images Uploaded</p>
            @endif

            {{-- Property Information --}}
            <div style="max-width: 600px; margin: auto; font-size: 16px; line-height: 1.8;">

                <p><strong>Type:</strong> {{ $property->property_type }}</p>
                <p><strong>Owner:</strong> {{ $property->vendor->firstname ?? 'Unknown' }} {{ $property->vendor->lastname ?? '' }}</p>
                <p><strong>Email:</strong> {{ $property->vendor->email ?? 'No Email' }}</p>
                <p><strong>Location:</strong> {{ $property->location }}</p>
                <p><strong>Guests:</strong> {{ $property->guests }}</p>
                <p><strong>Bathrooms:</strong> {{ $property->bathrooms }}</p>
                <p><strong>Children Allowed:</strong> {{ $property->children_allowed ? 'Yes' : 'No' }}</p>
                <p><strong>Pets Allowed:</strong> {{ $property->pets_allowed ? 'Yes' : 'No' }}</p>
                <p><strong>Price per Day:</strong> ${{ number_format($property->price_per_day, 2) }}</p>
                <p><strong>Status:</strong>
                    <span style="color: {{ $property->status == 'Approved' ? 'green' : ($property->status == 'Rejected' ? 'red' : 'orange') }};">
                    {{ ucfirst($property->status) }}
                </span>
                </p>

                <div style="margin-top: 20px; text-align: center;">
                    <form action="{{ route('admin.property.approve', $property->id) }}" method="POST" style="display: inline;">
                        @csrf
                        <button style="background: #28a745; color: white; border: none; padding: 8px 16px; border-radius: 8px; font-size: 16px; cursor: pointer; margin-right: 10px; transition: background 0.3s;">
                            <i class="uil uil-check"></i> Approve
                        </button>
                    </form>

                    <form action="{{ route('admin.property.reject', $property->id) }}" method="POST" style="display: inline;">
                        @csrf
                        <button style="background: #dc3545; color: white; border: none; padding: 8px 16px; border-radius: 8px; font-size: 16px; cursor: pointer; transition: background 0.3s;">
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

    {{-- Lightbox Scripts --}}
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

    {{-- Thumbnail Styling --}}
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
