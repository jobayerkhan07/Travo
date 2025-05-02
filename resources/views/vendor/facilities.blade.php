<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Property Facilities</title>
    <link rel="stylesheet" href="{{ asset('css/vendorCSS.css') }}">
</head>
<body>

    @include('layouts.vendorlayout') 
    <div class="container">
    <h1 style="font-size: 2.5rem; margin-bottom: 20px; color: rgb(1, 66, 1);">Facilities at Your Property</h1>
    <p style=" font-size: 1rem; color: #5d5252; margin-bottom: 20px;">Highlight the facilities you offer—like WiFi, air conditioning, or enterteinment to attract more guests and enhance their stay.</p>


    <form>
        
        <h2 style="font-size: 1.5rem; margin-bottom: 20px; color: rgb(1, 66, 1);">General</h2>
        <div>
            <input type="checkbox" name="air_conditioning" id="air_conditioning">
            <label for="air_conditioning">Air Conditioning</label>
        </div>
        <div>
            <input type="checkbox" name="eco" id="eco">
            <label for="eco">Eco Friendly</label>
        </div>
        <div>
            <input type="checkbox" name="free_wifi" id="free_wifi">
            <label for="free_wifi">Free WiFi</label>
        </div>

        <h2 style="font-size: 1.5rem; margin-bottom: 20px; color: rgb(1, 66, 1);">Entertainment</h2>
        <div>
            <input type="checkbox" name="movie" id="movie">
            <label for="movie">Outdoor Movie Night</label>
        </div>
        <div>
            <input type="checkbox" name="swimming_pool" id="swimming_pool">
            <label for="swimming_pool">Swimming Pool</label>
        </div>

        <div>
            <input type="checkbox" name="spa" id="spa">
            <label for="sap">Spa</label>
        </div>

        <div>
            <input type="checkbox" name="kids_zone" id="kids_zone">
            <label for="kids_zone">Kids Zone</label>
        </div>

        <div>
            <input type="checkbox" name="music" id="music">
            <label for="music">Live Music</label>
        </div>

        <button type="submit">Continue</button>
    </form>
</div>
    </body>
    </html>