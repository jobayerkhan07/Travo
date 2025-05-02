@extends('layouts.adminlayout')

@section('content')

    <div class="container" style="max-width: 1100px; margin: auto; padding: 30px;">

        <h1 style="font-size: 30px; font-weight: bold; text-align: center; margin-bottom: 30px; color: #014201;">
            Car Details
        </h1>

        <div style="background: #fff; border-radius: 12px; box-shadow: 0 6px 12px rgba(0,0,0,0.1); padding: 30px;">

            {{-- Car Model Name --}}
            <h2 style="text-align: center; color: #014201; font-size: 26px; margin-bottom: 20px;">
                {{ $car->car_model }}
            </h2>

            {{-- Car Images --}}
            @if(is_array($car->images) && count($car->images) > 0)
                <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 15px; margin-bottom: 30px;">
                    @foreach($car->images as $img)
                        <img src="{{ asset('storage/' . $img) }}"
                             class="small-thumb"
                             onclick="openLightbox('{{ asset('storage/' . $img) }}')"
                             alt="Car Image">
                    @endforeach
                </div>
            @else
                <p style="text-align: center; color: gray;">No Images Uploaded</p>
            @endif

            {{-- Car Information --}}
            <div style="max-width: 600px; margin: auto; font-size: 16px; line-height: 1.8;">

                <p><strong>Owner:</strong> {{ $car->owner_name }}</p>
                <p><strong>Phone:</strong> {{ $car->owner_phone }}</p>
                <p><strong>Email:</strong> {{ $car->owner_email }}</p>

                <p><strong>Passenger Capacity:</strong> {{ $car->capacity }}</p>
                <p><strong>Car Color:</strong> {{ $car->car_color ?? 'Not Specified' }}</p>
                <p><strong>Plate Number:</strong> {{ $car->plate_number }}</p>
                <p><strong>Air Conditioning:</strong> {{ $car->air_conditioning ? 'Yes' : 'No' }}</p>

                <p><strong>Price per Day:</strong> ${{ number_format($car->price_per_day, 2) }}</p>
                <p><strong>Price per Week:</strong> ${{ number_format($car->price_per_week, 2) }}</p>

                <p><strong>Status:</strong>
                    <span style="color:
                        {{ $car->status == 'approved' ? 'green' : ($car->status == 'rejected' ? 'red' : 'orange') }};
                            font-weight: bold;">
                        {{ ucfirst($car->status) }}
                    </span>
                </p>


                <div class="button-group">
                    {{-- Approve Button --}}
                    <form action="{{ route('admin.car.approve', $car->id) }}" method="POST" style="display: inline;">
                        @csrf
                        <button class="btn-approve" title="Approve">
                            <i class="uil uil-check"></i> Approve
                        </button>
                    </form>

                    {{-- Reject Button --}}
                    <form action="{{ route('admin.car.reject', $car->id) }}" method="POST" style="display: inline;">
                        @csrf
                        <button class="btn-reject" title="Reject">
                            <i class="uil uil-times"></i> Reject
                        </button>
                    </form>
                </div>


            </div>

        </div>

        {{-- Lightbox Modal --}}
        <div id="lightboxModal"
             style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.8); z-index: 9999; justify-content: center; align-items: center;">
            <span id="lightboxClose"
                  style="position: absolute; top: 20px; right: 30px; font-size: 30px; color: white; cursor: pointer;">&times;</span>
            <img id="lightboxImage" src="" style="max-width:90%; max-height:90%; border-radius: 10px;">
        </div>

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

        document.getElementById('lightboxModal').addEventListener('click', function (event) {
            if (event.target.id === 'lightboxModal' || event.target.id === 'lightboxClose') {
                closeLightbox();
            }
        });

        document.addEventListener('keydown', function (event) {
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
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }

        .btn-approve, .btn-reject {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin: 5px;
            transition: background 0.3s, transform 0.2s;
        }

        .btn-approve {
            background-color: #28a745; /* Green */
            color: white;
        }

        .btn-approve:hover {
            background-color: #218838;
            transform: scale(1.05);
        }

        .btn-reject {
            background-color: #dc3545; /* Red */
            color: white;
        }

        .btn-reject:hover {
            background-color: #c82333;
            transform: scale(1.05);
        }

        .button-group {
            text-align: center;
            margin-top: 20px;
        }
    </style>

@endsection
