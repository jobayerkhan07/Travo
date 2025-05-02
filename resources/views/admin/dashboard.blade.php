@extends('layouts.adminlayout');


@section('title', 'Admin Dashboard')



@section('content')

    <section class="main__wrapper">
        <section class="main__left">
            <h1 style="font-size: 30px;">Welcom back {{ $data->username }}</h1>
            <h1>Overview</h1>
            <br>
            <menu class="cards">

                {{-- Total Booking --}}
                <article class="card">
                    <i class="bx bx-calendar-check kpi-icon"></i>
                    <h5>Total Booking</h5>
                    <h2>{{ number_format($totalBookings) }}</h2>
                    <span class="delta {{ $dBookings >=0 ? 'positive' : 'negative' }}">
        {{ $dBookings >=0 ? '▲' : '▼' }} {{ abs($dBookings) }} %
        <small>vs&nbsp;last&nbsp;month</small>
     </span>
                </article>

                {{-- Total Users --}}
                <article class="card">
                    <i class="bx bx-user kpi-icon"></i>
                    <h5>Total Users</h5>
                    <h2>{{ number_format($totalUsers) }}</h2>
                    <span class="delta {{ $dUsers >=0 ? 'positive' : 'negative' }}">
        {{ $dUsers >=0 ? '▲' : '▼' }} {{ abs($dUsers) }} %
                        <small>vs&nbsp;last&nbsp;month</small>
     </span>
                </article>

                {{-- Total Vendors --}}
                <article class="card">
                    <i class="bx bx-buildings kpi-icon"></i>
                    <h5>Total Vendors</h5>
                    <h2>{{ number_format($totalVendors) }}</h2>
                    <span class="delta {{ $dVendors >=0 ? 'positive' : 'negative' }}">
        {{ $dVendors >=0 ? '▲' : '▼' }} {{ abs($dVendors) }} %
                        <small>vs&nbsp;last&nbsp;month</small>
     </span>
                </article>

                {{-- Total Revenue --}}
                <article class="card">
                    <i class="bx bx-dollar-circle kpi-icon"></i>
                    <h5>Total Revenue <small>(website&nbsp;30 %)</small></h5>
                    <h2>{{ number_format($totalRevenue,2) }} Tk</h2>
                    <span class="delta {{ $dRevenue >=0 ? 'positive' : 'negative' }}">
        {{ $dRevenue >=0 ? '▲' : '▼' }} {{ abs($dRevenue) }} %
                        <small>vs&nbsp;last&nbsp;month</small>
     </span>
                </article>

            </menu>

        </section>
    </section>

    <div class="charts-wrapper"
         style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
            gap:1.5rem;margin-top:2rem;">

        <div class="chart-box" style="height:300px;">
            <canvas id="chart-bookings"></canvas>
            <h3>Booking Load</h3>
        </div>

        <div class="chart-box" style="height:300px;">
            <canvas id="chart-revenue"></canvas>
            <h3>Revenue Sharing</h3>
        </div>

        <div class="chart-box" style="height:300px;">
            <canvas id="chart-roles"></canvas>
            <h3>User Count</h3>
        </div>
    </div>


@endsection

@push('scripts')
    <script>
        /* A) Line – bookings per month */
        new Chart(document.getElementById('chart-bookings'), {
            type: 'line',
            data: {
                labels:@json($months),
                datasets: [{
                    label: 'Bookings',
                    data:@json($bookingData),
                    borderWidth: 2,
                    tension: .3
                }]
            },
            options: {plugins: {legend: {display: false}}}
        });

        /* B) Doughnut – revenue split */
        new Chart(document.getElementById('chart-revenue'), {
            type: 'doughnut',
            data: {
                labels: ['Website Owners 30%', 'Vendors 70%'],
                datasets: [{data: [{{ $adminShare }}, {{ $vendorShare }}]}]
            },
            options: {plugins: {legend: {position: 'bottom'}}}
        });

        /* C) Pie – users by role */
        new Chart(document.getElementById('chart-roles'), {
            type: 'pie',
            data: {
                labels:@json($roles->keys()),
                datasets: [{data:@json($roles->values())}]
            },
            options: {plugins: {legend: {position: 'bottom'}}}
        });
    </script>
@endpush
