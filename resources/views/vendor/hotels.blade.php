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


<div class="container">
    <h1 style="font-size: 20px; font-weight: bold; text-align: left; margin-bottom: 10px;">
    Hotel Details Review
    </h1>


        <div class="row">
            <div class="col-12">
                <table border="1">
                    <thead>
                        <tr class="heading">
                            <th>ID</th>
                            <th>Property Name</th>
                            <th>Property type</th>
                            <th>Location</th>
                            <th>Address</th>
                            <th>Guest Number</th>
                            <th>Price Per Night</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Image</th> 
                            <th>Action</th>
                        </tr>
                    </thead>

<!-- sample data so i didnt use blade variable kindly change according to u -->

                    <tbody ID="data">
                        <tr>
                            <td>01</td>
                            <td>samresort</td>
                            <td>RESORT</td>
                            <td>MIRPUR</td>
                            <td>ABC</td>
                            <td>4</td>
                            <td>7000</td>
                            <td></td>
                            <td>10 AM</td>
                            <td>9AM</td>
                            <td class="action-buttons">
                                <button class="edit"><i class="uil uil-check"></i></button>
                                <button class="delete"><i class="uil uil-times"></i></button>
                                <button class="view"><i class="uil uil-eye"></i></button>
                            </td>
                        </tr>


                    </tbody>
                </table>
            </div>

        </div>


        <div class="container">
    <h1 style="font-size: 20px; font-weight: bold; text-align: left; margin-bottom: 10px;">
    Room Details Review
    </h1>


        <div class="row">
            <div class="col-12">
                <table border="1">
                    <thead>
                        <tr class="heading">
                            <th>ID</th>
                            <th>Property Name</th>
                            <th>Property type</th>
                            <th>Room Number</th>
                            <th>Floor Number</th>
                            <th>Guest Number</th>
                            <th>Room Size</th>
                            <th>Price Per Night</th>
                            <th>Available From</th>

                            <th>Available To</th>
                            <th>Image</th> 
                            <th>Action</th>
                        </tr>
                    </thead>

<!-- sample data so i didnt use blade variable kindly change according to u -->

                    <tbody ID="data">
                        <tr>
                            <td>01</td>
                            <td>samresort</td>
                            <td>RESORT</td>
                            <td>MIRPUR</td>
                            <td>ABC</td>
                            <td>4</td>
                            <td>7000</td>
                            <td></td>
                            <td>10 AM</td>
                            <td>9AM</td>
                            <td class="action-buttons">
                                <button class="edit"><i class="uil uil-check"></i></button>
                                <button class="delete"><i class="uil uil-times"></i></button>
                                <button class="view"><i class="uil uil-eye"></i></button>
                            </td>
                        </tr>


                    </tbody>
                </table>
            </div>

        </div>

        </body>
        </html>