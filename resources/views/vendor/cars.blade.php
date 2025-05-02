<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Car</title>
    <link rel="stylesheet" href="{{ asset('css/vendorCSS.css') }}">
</head>
<body>

@include('layouts.vendorlayout')

<div class="container" style="max-width: 1100px; margin: auto; padding: 30px;">

    <h1 style="font-size: 2.5rem; margin-bottom: 20px; color: rgb(1, 66, 1); text-align: center;">Add Your Transport Details</h1>
    <p style="font-size: 1rem; color: #5d5252; text-align: center; margin-bottom: 30px;">All information should be authentic and accurate to help guests make informed decisions and ensure a smooth experience.</p>

    @if(session('success'))
        <div style="color: green; text-align: center; margin-bottom: 20px;">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger" style="margin-bottom: 20px;">
            <ul style="margin-left: 20px;">
                @foreach($errors->all() as $error)
                    <li style="color: red;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('vendor.storeCar') }}" enctype="multipart/form-data" style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
        @csrf

        <!-- Owner Details -->
        <div class="form-row">
            <div class="form-group">
                <label for="owner_name" style="font-weight: bold;">Owner Name</label>
                <input type="text" name="owner_name" id="owner_name" required>
            </div>

            <div class="form-group">
                <label for="owner_phone" style="font-weight: bold;">Owner Phone Number</label>
                <input type="text" name="owner_phone" id="owner_phone" required>
            </div>
        </div>

        <div class="form-group">
            <label for="owner_email" style="font-weight: bold;">Owner Email</label>
            <input type="email" name="owner_email" id="owner_email" required>
        </div>

        <!-- Car Details -->
        <div class="form-row">
            <div class="form-group">
                <label for="car_model" style="font-weight: bold;">Car Model</label>
                <input type="text" name="car_model" id="car_model" required>
            </div>

            <div class="form-group">
                <label for="capacity" style="font-weight: bold;">Passenger Capacity</label>
                <input type="number" name="capacity" id="capacity" min="1" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="car_color" style="font-weight: bold;">Car Color</label>
                <input type="text" name="car_color" id="car_color">
            </div>

            <div class="form-group">
                <label for="plate_number" style="font-weight: bold;">Car Plate Number</label>
                <input type="text" name="plate_number" id="plate_number" required>
            </div>
        </div>

        <!-- Car Features -->
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

        <!-- Upload Images -->
        <div class="form-group">
            <label for="images" style="font-weight: bold;">Upload Car Images</label>
            <input type="file" name="images[]" id="images" multiple required>
        </div>

        <!-- Pricing -->
        <div class="form-row">
            <div class="form-group">
                <label for="price_per_day" style="font-weight: bold;">Price per Day (BDT)</label>
                <input type="number" name="price_per_day" id="price_per_day" min="0" required>
            </div>

            <div class="form-group">
                <label for="price_per_week" style="font-weight: bold;">Price per Week (BDT)</label>
                <input type="number" name="price_per_week" id="price_per_week" min="0" required>
            </div>
        </div>

        <!-- Submit -->
        <div style="text-align: center; margin-top: 30px;">
            <button type="submit" style="padding: 12px 30px; font-size: 18px; background: #014201; color: white; border: none; border-radius: 8px; cursor: pointer;">
                Submit Car
            </button>
        </div>

    </form>
</div>

<!-- Internal Styling -->
<style>
    .form-row {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 20px;
    }
    .form-group {
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .form-group label {
        font-weight: bold;
        margin-bottom: 6px;
    }
    .form-group input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
    }
    .radio-wrapper {
        display: flex;
        gap: 30px;
        margin-top: 10px;
    }
    .radio-label {
        display: flex;
        align-items: center;
        font-weight: 600;
        gap: 8px;
    }
</style>

</body>
</html>
