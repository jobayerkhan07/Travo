@extends('layouts.adminlayout')

@section('content')

    <div class="container">

        <h1 style="font-size: 30px; font-weight: bold; text-align: left; margin-bottom: 20px;">Vendors Management</h1>

        {{-- Hotel Vendors --}}
        <div>
            <h2 style="font-size: 20px; font-weight: bold; margin-bottom: 10px;">Hotel Vendors</h2>

            <table border="1" style="width:100%; margin-bottom: 20px;">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Vendor's Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($hotelVendors as $vendor)
                    <tr>
                        <td>{{ $vendor->id }}</td>
                        <td>{{ $vendor->firstname }} {{ $vendor->lastname }}</td>
                        <td>{{ $vendor->email }}</td>
                        <td>{{ $vendor->phone ?? 'N/A' }}</td>
                        <td>{{ ucfirst($vendor->status ?? 'Pending') }}</td>
                        <td class="action-buttons">

                            {{-- Approve Vendor --}}
                            <form action="{{ route('admin.vendor.approve', $vendor->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button class="edit" title="Approve Vendor" onclick="return confirm('Are you sure to approve this vendor?')">
                                    <i class="uil uil-check"></i>
                                </button>
                            </form>

                            {{-- Delete Vendor --}}
                            <form action="{{ route('admin.vendor.delete', $vendor->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button class="delete" title="Delete Vendor" onclick="return confirm('Are you sure to delete this vendor and all their listings? This action cannot be undone!')">
                                    <i class="uil uil-times"></i>
                                </button>
                            </form>

                            {{-- View Vendor Listings --}}
                            <a href="{{ route('admin.vendor.listings', $vendor->id) }}">
                                <button class="view" title="View Vendor Listings">
                                    <i class="uil uil-eye"></i>
                                </button>
                            </a>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{-- Pagination for Hotels --}}
            {{ $hotelVendors->links() }}

        </div>

        {{-- Car Vendors --}}
        <div style="margin-top: 40px;">
            <h2 style="font-size: 20px; font-weight: bold; margin-bottom: 10px;">Car Vendors</h2>

            <table border="1" style="width:100%; margin-bottom: 20px;">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Car Owner's Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($carVendors as $vendor)
                    <tr>
                        <td>{{ $vendor->id }}</td>
                        <td>{{ $vendor->firstname }} {{ $vendor->lastname }}</td>
                        <td>{{ $vendor->email }}</td>
                        <td>{{ $vendor->phone ?? 'N/A' }}</td>
                        <td>{{ ucfirst($vendor->status ?? 'Pending') }}</td>
                        <td class="action-buttons">

                            {{-- Approve Vendor --}}
                            <form action="{{ route('admin.vendor.approve', $vendor->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button class="edit" title="Approve Vendor" onclick="return confirm('Are you sure to approve this vendor?')">
                                    <i class="uil uil-check"></i>
                                </button>
                            </form>

                            {{-- Delete Vendor --}}
                            <form action="{{ route('admin.vendor.delete', $vendor->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button class="delete" title="Delete Vendor" onclick="return confirm('Are you sure to delete this vendor and all their listings? This action cannot be undone!')">
                                    <i class="uil uil-times"></i>
                                </button>
                            </form>

                            {{-- View Vendor Listings --}}
                            <a href="{{ route('admin.vendor.listings', $vendor->id) }}">
                                <button class="view" title="View Vendor Listings">
                                    <i class="uil uil-eye"></i>
                                </button>
                            </a>

                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>

            {{-- Pagination for Cars --}}
            {{ $carVendors->links() }}

        </div>

    </div>

@endsection
