<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Room</title>
    <link rel="stylesheet" href="{{ asset('css/vendorCSS.css') }}">
</head>
<body>

@include('layouts.vendorlayout')

<div class="container" style="max-width: 900px; margin: auto; padding: 30px;">

    <h1 style="font-size: 2.5rem; color: rgb(1, 66, 1); text-align: center; margin-bottom: 20px;">Add Room Details</h1>
    <p style="font-size: 1rem; color: #5d5252; text-align: center; margin-bottom: 30px;">
        Mention all room details clearly. Accurate information builds trust and increases your chances of getting booked!
    </p>

    @if(session('success'))
        <div style="color: green; text-align: center; margin-bottom: 20px;">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div style="background: #f8d7da; padding: 15px; margin-bottom: 20px; border: 1px solid #f5c6cb; border-radius: 5px;">
            <ul style="margin-left: 20px; color: red;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('vendor.storeRoom') }}" enctype="multipart/form-data">
        @csrf
        <div style="display: flex; flex-wrap: wrap; gap: 20px;">
            <div style="flex: 1;">
                <label for="property_name" style="font-weight: bold;">Property Name:</label>
                <input type="text" name="property_name" id="property_name" value="{{ old('property_name') }}" required>

                <label for="room_number" style="font-weight: bold;">Room Number:</label>
                <input type="text" name="room_number" id="room_number" required>

                <label for="floor_number" style="font-weight: bold;">Floor Number:</label>
                <input type="number" name="floor_number" id="floor_number" required>

                <label for="room_size" style="font-weight: bold;">Room Size (sq meters):</label>
                <input type="number" name="room_size" id="room_size" required>
            </div>

            <div style="flex: 1;">
                <label for="location" style="font-weight: bold;">Location:</label>
                <input type="text" name="location" id="location" value="{{ old('location') }}" required>

                <label for="room_type" style="font-weight: bold;">Room Type:</label>
                <input type="text" name="room_type" id="room_type" required>

                <label for="num_beds" style="font-weight: bold;">Number of Beds:</label>
                <input type="number" name="num_beds" id="num_beds" required>

                <label for="max_capacity" style="font-weight: bold;">Max Capacity (People):</label>
                <input type="number" name="max_capacity" id="max_capacity" required>
            </div>
        </div>

        <div class="form-group">
            <label style="font-weight: bold;">Air Conditioning Available?</label>
            <div class="radio-wrapper">
                <label class="radio-label">
                    <input type="radio" name="air_conditioning" value="1" required> Yes
                </label>
                <label class="radio-label">
                    <input type="radio" name="air_conditioning" value="0"> No
                </label>
            </div>
        </div>

        <div class="form-group">
            <label style="font-weight: bold;">WiFi Available?</label>
            <div class="radio-wrapper">
                <label class="radio-label">
                    <input type="radio" name="wifi" value="1" required> Yes
                </label>
                <label class="radio-label">
                    <input type="radio" name="wifi" value="0"> No
                </label>
            </div>
        </div>

        <div class="form-group">
            <label style="font-weight: bold;">Balcony Available?</label>
            <div class="radio-wrapper">
                <label class="radio-label">
                    <input type="radio" name="balcony" value="1" required> Yes
                </label>
                <label class="radio-label">
                    <input type="radio" name="balcony" value="0"> No
                </label>
            </div>
        </div>

        <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-top: 30px;">
            <div style="flex: 1;">
                <label for="price_per_night" style="font-weight: bold;">Price per Night (BDT):</label>
                <input type="number" name="price_per_night" id="price_per_night" required>
            </div>

            <div style="flex: 1;">
                <label for="extra_guest_price" style="font-weight: bold;">Price for Extra Guest (BDT):</label>
                <input type="number" name="extra_guest_price" id="extra_guest_price">
            </div>
        </div>

        <div style="margin-top: 30px;">
            <label for="room_images" style="font-weight: bold;">Upload Room Photos:</label>
            <input type="file" name="room_images[]" id="room_images" multiple required>
        </div>

        <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-top: 30px;">
            <div style="flex: 1;">
                <label for="available_from" style="font-weight: bold;">Available From:</label>
                <input type="date" name="available_from" id="available_from" required>
            </div>

            <div style="flex: 1;">
                <label for="available_to" style="font-weight: bold;">Available To:</label>
                <input type="date" name="available_to" id="available_to" required>
            </div>
        </div>

        <div style="text-align: center; margin-top: 40px;">
            <button type="submit" style="padding: 12px 30px; background-color: rgb(1, 66, 1); color: white; font-size: 18px; border: none; border-radius: 8px; cursor: pointer;">
                Submit Room Details
            </button>
        </div>

    </form>

</div>

<style>
    .form-group {
        margin-bottom: 20px;
    }
    .radio-wrapper {
        display: flex;
        gap: 20px;
        margin-top: 8px;
    }
    .radio-label {
        font-weight: normal;
        display: flex;
        align-items: center;
        gap: 5px;
    }
</style>

</body>
</html>
