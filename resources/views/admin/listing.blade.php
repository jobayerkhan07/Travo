@extends('layouts.adminlayout')

@section('content')

    <body>

    <div class="container">
        <h1 style="font-size: 30px; font-weight: bold; text-align: left; margin-bottom: 10px;">
            Listing Management
        </h1>

        <div class="container">
            <h1 style="font-size: 20px; font-weight: bold; text-align: left; margin-bottom: 10px;">
                Hotel Listings Review
            </h1>

            <div class="row">
                <div class="col-12">
                    <table border="1" style="width: 100%;">
                        <thead>
                        <tr class="heading">
                            <th>ID</th>
                            <th>Hotel Name</th>
                            <th>Owner Name</th>
                            <th>Email</th>
                            <th>Hotel Category</th>
                            <th>Location</th>
                            <th>Total Rooms</th>
                            <th>Average Pricing</th>
                            <th>Request Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($properties as $property)
                            <tr>
                                <td>{{ $property->id }}</td>
                                <td>{{ $property->property_name }}</td>
                                <td>{{ $property->vendor->firstname ?? 'Unknown' }} {{ $property->vendor->lastname ?? '' }}</td>
                                <td>{{ $property->vendor->email ?? 'No Email' }}</td>
                                <td>{{ $property->property_type }}</td>
                                <td>{{ $property->location }}</td>
                                <td>{{ $property->total_rooms ?? 'N/A' }}</td>
                                <td>${{ number_format($property->price_per_day, 2) }}</td>
                                <td>{{ $property->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <span style="color: {{ $property->status == 'Approved' ? 'green' : ($property->status == 'Rejected' ? 'red' : 'orange') }};">
                                        {{ ucfirst($property->status) }}
                                    </span>
                                </td>

                                <td class="action-buttons">
                                    <form action="{{ route('admin.property.approve', $property->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button class="edit" title="Approve"><i class="uil uil-check"></i></button>
                                    </form>

                                    <form action="{{ route('admin.property.reject', $property->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button class="delete" title="Reject"><i class="uil uil-times"></i></button>
                                    </form>

                                    <a href="{{ route('admin.property.view', $property->id) }}">
                                        <button class="view" title="View Details"><i class="uil uil-eye"></i></button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

        <!-- ========================== -->
        <!-- Now start Car Listings part -->
        <!-- ========================== -->

        <div class="container" style="margin-top: 50px;">
            <h1 style="font-size: 20px; font-weight: bold; text-align: left; margin-bottom: 10px;">
                Car Listings Review
            </h1>

            <div class="row">
                <div class="col-12">
                    <table border="1" style="width: 100%;">
                        <thead>
                        <tr class="heading">
                            <th>ID</th>
                            <th>Car Model</th>
                            <th>Owner Name</th>
                            <th>Owner Phone</th>
                            <th>Owner Email</th>
                            <th>Capacity</th>
                            <th>Plate Number</th>
                            <th>Daily Price</th>
                            <th>Request Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($cars as $car)
                            <tr>
                                <td>{{ $car->id }}</td>
                                <td>{{ $car->car_model }}</td>
                                <td>{{ $car->owner_name }}</td>
                                <td>{{ $car->owner_phone }}</td>
                                <td>{{ $car->owner_email }}</td>
                                <td>{{ $car->capacity }}</td>
                                <td>{{ $car->plate_number }}</td>
                                <td>${{ number_format($car->price_per_day, 2) }}</td>
                                <td>{{ $car->created_at->format('Y-m-d') }}</td>
                                {{-- <td>
                                    <span style="color: {{ $car->status == 'Approved' ? 'green' : ($car->status == 'Rejected' ? 'red' : 'orange') }};">
                                        {{ ucfirst($car->status) }}
                                    </span>
                                </td> --}}
                                @php
                                    $carStatus = strtolower(trim($car->status));
                                    $carColour = $carStatus === 'approved'
                                                ? 'green'
                                                : ($carStatus === 'rejected' ? 'red' : 'orange');
                                @endphp

                                <td>
                                <span style="color:{{ $carColour }};">
                                    {{ ucfirst($carStatus) }}
                                </span>
                                </td>


                                <td class="action-buttons">
                                    <form action="{{ route('admin.car.approve', $car->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button class="edit" title="Approve"><i class="uil uil-check"></i></button>
                                    </form>

                                    <form action="{{ route('admin.car.reject', $car->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button class="delete" title="Reject"><i class="uil uil-times"></i></button>
                                    </form>

                                    <a href="{{ route('admin.car.view', $car->id) }}">
                                        <button class="view" title="View Details"><i class="uil uil-eye"></i></button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

{{--        rooms section--}}
        <div class="container" style="margin-top: 60px;">
            <h1 style="font-size: 20px; font-weight: bold; text-align: left; margin-bottom: 10px;">
                Room Listings Review
            </h1>

            <div class="row">
                <div class="col-12">
                    <table border="1" style="width: 100%; text-align: center;">
                        <thead>
                        <tr class="heading">
                            <th>ID</th>
                            <th>Room Number</th>
                            <th>Room Type</th>
                            <th>Owner Name</th>
                            <th>Owner Email</th>
                            <th>Floor Number</th>
                            <th>Price per Night</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($rooms as $room)
                            <tr>
                                <td>{{ $room->id }}</td>
                                <td>{{ $room->room_number }}</td>
                                <td>{{ ucfirst($room->room_type) }}</td>
                                <td>{{ $room->vendor->firstname ?? 'Unknown' }} {{ $room->vendor->lastname ?? '' }}</td>
                                <td>{{ $room->vendor->email ?? 'No Email' }}</td>
                                <td>{{ $room->floor_number }}</td>
                                <td>${{ number_format($room->price_per_night, 2) }}</td>
                                <td>
                                <span style="color: {{ $room->status == 'Approved' ? 'green' : ($room->status == 'Rejected' ? 'red' : 'orange') }};">
                                    {{ ucfirst($room->status) }}
                                </span>
                                </td>
                                <td class="action-buttons">
                                    <form action="{{ route('admin.room.approve', $room->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button class="edit" title="Approve"><i class="uil uil-check"></i></button>
                                    </form>

                                    <form action="{{ route('admin.room.reject', $room->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button class="delete" title="Reject"><i class="uil uil-times"></i></button>
                                    </form>

                                    <a href="{{ route('admin.room.view', $room->id) }}">
                                        <button class="view" title="View Details"><i class="uil uil-eye"></i></button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>


    </div>

    </body>
@endsection
