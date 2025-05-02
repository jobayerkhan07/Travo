<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Property Services</title>
    <link rel="stylesheet" href="{{ asset('css/vendorCSS.css') }}">
</head>
<body>

    @include('layouts.vendorlayout') 
    <div class="container">
    <h1 style="font-size: 2.5rem; margin-bottom: 20px; color: rgb(1, 66, 1);">Services at Your Property</h1>
    <p style=" font-size: 1rem; color: #5d5252; margin-bottom: 20px;">Highlight the services you provide to attract more guests and enhance their stay.</p>


    <form>
        
        <h2 style="font-size: 1.5rem; margin-bottom: 20px; color: rgb(1, 66, 1);">Breakfast</h2>
        
        <div class="radio-button">
            <input type="radio" name="breakfast" id="breakfast_yes" value="yes">
            <label for="breakfast_yes">Yes</label>
        </div>
        <div class="radio-button">
            <input type="radio" name="breakfast" id="breakfast_no" value="no" checked>
            <label for="breakfast_no">No</label>
        </div>

        <h2>Parking</h2>
        <div class="radio-button">
            <input type="radio" name="parking" id="parking_yes_free" value="yes_free">
            <label for="parking_yes_free">Yes, Free</label>
        </div>
        <div class="radio-button">
            <input type="radio" name="parking" id="parking_yes_paid" value="yes_paid">
            <label for="parking_yes_paid">Yes, Paid</label>
        </div>
        <div class="radio-button">
            <input type="radio" name="parking" id="parking_no" value="no" checked>
            <label for="parking_no">No</label>
        </div>

        <button type="submit">Submit Property</button>
    </form>
</div>
    </body>
    </html>