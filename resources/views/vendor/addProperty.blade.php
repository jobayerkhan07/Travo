<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Property</title>
    <link rel="stylesheet" href="{{ asset('css/vendorCSS.css') }}">
</head>
<body>

@include('layouts.vendorlayout')

<div class="container">
    <h1 style="font-size: 2.5rem; margin-bottom: 20px; color: rgb(1, 66, 1);">Add Your Property Details</h1>
    <p style="font-size: 1rem; color: #5d5252; margin-bottom: 20px;">
        All information should be authentic and accurate. This will help guests make informed decisions and ensure a smooth experience.
    </p>

    @if($errors->any())
        <div class="alert alert-danger" style="margin-bottom: 20px;">
            <ul style="margin-left: 20px;">
                @foreach($errors->all() as $error)
                    <li style="color: red;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('vendor.storeProperty') }}" enctype="multipart/form-data">
        @csrf

        <div>
            <label for="property_name" style="font-weight: bold;">Property Name:</label>
            <input type="text" name="property_name" id="property_name" value="{{ old('property_name') }}" required>

            <label for="property_type" style="font-weight: bold;">Property Type:</label>
            <input type="text" name="property_type" id="property_type" value="{{ old('property_type') }}" required>
        </div>

        <div>
            <label for="location" style="font-weight: bold;">Location:</label>
            <input type="text" name="location" id="location" value="{{ old('location') }}" required>

            <label for="address" style="font-weight: bold;">Address:</label>
            <input type="text" name="address" id="address" value="{{ old('address') }}" required>
        </div>

        <div>
            <label for="description" style="font-weight: bold;">Description:</label>
            <textarea style="resize: vertical;" name="description" id="description" required>{{ old('description') }}</textarea>
        </div>

        <div>
            <label for="guests" style="font-weight: bold;">How many guests can stay?</label>
            <input type="number" name="guests" id="guests" value="{{ old('guests') }}" required>

            <label for="bathrooms" style="font-weight: bold;">How many bathrooms are there?</label>
            <input type="number" name="bathrooms" id="bathrooms" value="{{ old('bathrooms') }}" required>
        </div>

        <div class="form-group">
            <label style="font-weight: bold;">Do you allow children?</label>
            <div class="radio-wrapper">
                <label class="radio-label">
                    <input type="radio" name="children_allowed" id="children_yes" value="1" {{ old('children_allowed') == '1' ? 'checked' : '' }}> Yes
                </label>
                <label class="radio-label">
                    <input type="radio" name="children_allowed" id="children_no" value="0" {{ old('children_allowed') == '0' ? 'checked' : '' }}> No
                </label>
            </div>
        </div>

        <div class="form-group" style="margin-top: 10px;">
            <label for="children_no_count" style="font-weight: bold;">Max number of children allowed:</label>
            <input type="number" name="children_no" id="children_no_count" value="{{ old('children_no', 0) }}" min="0" required>
        </div>

        <div class="form-group" style="margin-top: 20px;">
            <label style="font-weight: bold;">Do you allow pets?</label>
            <div class="radio-wrapper">
                <label class="radio-label">
                    <input type="radio" name="pets_allowed" id="pets_yes" value="1" {{ old('pets_allowed') == '1' ? 'checked' : '' }}> Yes
                </label>
                <label class="radio-label">
                    <input type="radio" name="pets_allowed" id="pets_no" value="0" {{ old('pets_allowed') == '0' ? 'checked' : '' }}> No
                </label>
            </div>
        </div>

        <div class="form-group" style="margin-top: 10px;">
            <label for="pets_no_count" style="font-weight: bold;">Max number of pets allowed:</label>
            <input type="number" name="pets_no" id="pets_no_count" value="{{ old('pets_no', 0) }}" min="0" required>
        </div>


        <div>
            <label for="room_size" style="font-weight: bold;">Room Size (sq meters):</label>
            <input type="number" name="room_size" id="room_size" value="{{ old('room_size') }}" required>
        </div>

        <div>
            <label for="images" style="font-weight: bold;">Upload Images:</label>
            <input type="file" name="images[]" id="images" multiple required>
        </div>

        <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-top: 20px;">

            <div style="flex: 1;">
                <label for="price_per_day" style="display: block; font-weight: bold; margin-bottom: 6px;">Price per Night:</label>
                <input type="number" name="price_per_day" id="price_per_day" value="{{ old('price_per_day') }}"
                       style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;" required>
            </div>

            <div style="flex: 1;">
                <label for="check_in_time" style="display: block; font-weight: bold; margin-bottom: 6px;">Available from:</label>
                <input type="date" name="check_in_time" id="check_in_time" value="{{ old('check_in_time') }}"
                       style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;" required>
            </div>

            <div style="flex: 1;">
                <label for="check_out_time" style="display: block; font-weight: bold; margin-bottom: 6px;">Available to:</label>
                <input type="date" name="check_out_time" id="check_out_time" value="{{ old('check_out_time') }}"
                       style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;" required>
            </div>

        </div>

        <div style="text-align: center; margin-top: 30px;">
            <button type="submit" style="padding: 12px 30px; font-size: 18px; background: #014201; color: white; border: none; border-radius: 8px; cursor: pointer;">
                Continue
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
