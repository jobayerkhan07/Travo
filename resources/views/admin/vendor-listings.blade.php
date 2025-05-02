@extends('layouts.adminlayout')

@section('content')

    <div class="container" style="max-width: 1100px; margin: auto; padding: 30px 20px;">

        <h1 style="font-size: 28px; font-weight: bold; text-align: center; margin-bottom: 30px; color: #014201;">
            Listings by {{ $vendor->firstname }} {{ $vendor->lastname }}
        </h1>

        <table border="1" style="width: 100%; text-align: center; margin-bottom: 30px;">
            <thead>
            <tr>
                <th>ID</th>
                <th>Property Name</th>
                <th>Type</th>
                <th>Location</th>
                <th>Guests</th>
                <th>Price per Night</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @forelse($properties as $property)
                <tr>
                    <td>{{ $property->id }}</td>
                    <td>{{ $property->property_name }}</td>
                    <td>{{ ucfirst($property->property_type) }}</td>
                    <td>{{ $property->location }}</td>
                    <td>{{ $property->guests }}</td>
                    <td>${{ number_format($property->price_per_day, 2) }}</td>
                    <td>
                        <span style="color: {{ $property->status == 'Approved' ? 'green' : ($property->status == 'Rejected' ? 'red' : 'orange') }};">
                            {{ ucfirst($property->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.property.view', $property->id) }}">
                            <button class="view" title="View Property"><i class="uil uil-eye"></i></button>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="color: gray;">No Listings Found</td>
                </tr>
            @endforelse
            </tbody>
        </table>

    </div>

@endsection
