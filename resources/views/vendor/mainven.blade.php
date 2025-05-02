<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRAVO | BUISNESS PARTNER</title>
    <link rel="stylesheet" href="{{ asset('css/vendorCSS.css') }}">
</head>
<body>

    @include('layouts.vendorlayout')

<!-- option box -->
<div class="container">
    <h1 style="font-size: 2.5rem; margin-bottom: 10px;">List your hotel or rent car with us and start reaching travelers worldwide now!</h1>
    <p style="font-size: 1rem; margin-bottom: 30px; color: rgb(61, 57, 57);">Thank you for choosing to partner with us! We're excited to have you on board as a valued vendor. By listing your hotels and rental cars, you're helping travelers explore the world with comfort and ease.</p>

    <div class="box-container">


        <div class="box">
            <div class="icon">
                <i class='bx bx-home' ></i>
            </div>
            <h2 style="font-size: 1.8rem; margin-bottom: 10px;">Hotels & Resort</h2>
            <p style=" font-size: 1rem; color: #5d5252; margin-bottom: 20px;">Share the details of your property and upload authentic pictures..</p>

            <a href="{{ route('vendor.addProperty') }}">
            <button class="list-service">Add property</button>
            </a>
        </div>



        <div class="box">
            <div class="icon">
                <i class='bx bx-car'></i>
            </div>
            <h2 style="font-size: 1.8rem; margin-bottom: 10px;">Transport</h2>
            <p style=" font-size: 1rem; color: #5d5252; margin-bottom: 20px;">Share the details of your rental car with valid information</p>

            <a href="{{ route('vendor.cars') }}">
            <button class="list-service">Add Transport service</button>
            </a>
        </div>


        <div class="box">
            <div class="icon">
            <i class='bx bx-home-alt-2'></i>
            </div>
            <h2 style="font-size: 1.8rem; margin-bottom: 10px;">Add Room Details</h2>
            <p style=" font-size: 1rem; color: #5d5252; margin-bottom: 20px;">Provide detailed information about each room you offer</p>

            <a href="{{ route('vendor.rooms') }}">
            <button class="list-service">Add Room Details</button>
            </a>
        </div>

        <div class="box">
            <div class="icon">
            <i class='bx bxl-stack-overflow' ></i>
            </div>
            <h2 style="font-size: 1.8rem; margin-bottom: 10px;">Overview</h2>
            <p style=" font-size: 1rem; color: #5d5252; margin-bottom: 20px;">Check out your buisness and overall information.</p>

            <a href="{{ route('vendor.showOverview') }}">
            <button class="list-service">Continue</button>
            </a>
        </div>


</body>
</html>






