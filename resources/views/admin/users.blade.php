@extends('layouts.adminlayout')

@section('content')
    <div class="container">
        <h1 style="font-size:30px;font-weight:bold;margin-bottom:10px;">User Management</h1>

        <div style="margin-bottom:10px;">
            <h2 style="font-size:20px;font-weight:bold;">User Details</h2>
        </div>

        <div class="row">
            <div class="col-12">
                <table border="1">
                    <thead>
                    <tr class="heading">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody id="data">
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->firstname }} {{ $user->lastname }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone_number }}</td>
                            <td>{{ $user->status ?? 'active' }}</td>

                            <td class="action-buttons">
                                <button class="edit"><i class="uil uil-edit"></i></button>
                                <button class="delete"><i class="uil uil-trash"></i></button>
                                <button class="view"><i class="uil uil-eye"></i></button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="text-align:center;padding:1rem;">
                                No users found.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

                {{-- pagination --}}
                <div style="margin-top:1rem;">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
