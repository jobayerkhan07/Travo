<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>


    <!-- favicon -->
    <link rel="shortcut icon" href="images/topicon.png" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="stylesheet" href="{{ asset('css/customCSS.css') }}">
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar">
        <a href="#" class="sidebar__logo">
            <img src="{{asset('images/logo.png')}}" alt="Logo">
            <h3>TRA<span class="highlight">V</span>O</h3>
        </a>
        <menu class="sidebar__top">

            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="uil uil-create-dashboard"></i>
                <h5>Dashboard</h5>
            </a>

            <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users') ? 'active' : '' }}">
                <i class="uil uil-user"></i>
                <h5>User</h5>
            </a>

            <a href="{{ route('admin.listing') }}" class="{{ request()->routeIs('admin.listings') ? 'active' : '' }}">
                <i class="uil uil-list-ul"></i>
                <h5>Listing Request</h5>
            </a>

            <a href="{{ route('admin.vendors') }}" class="{{ request()->routeIs('admin.vendors') ? 'active' : '' }}">
                <i class="uil uil-store"></i>
                <h5>Vendors</h5>
            </a>

            <a href="{{ route('admin.payments') }}" class="{{ request()->routeIs('admin.payments') ? 'active' : '' }}">
                <i class="uil uil-credit-card-search"></i>
                <h5>Payments</h5>
            </a>
            </a> -->
        </menu>
        <menu class="sidebar__bottom">
            <a href="{{ route('admin.logout') }}">
                <i class="uil uil-signout"></i>
                <h5>Log Out</h5>
            </a>
        </menu>
    </aside>

    <!-- Main Content -->
    <main>
        <!-- Navbar -->
        <nav class="navbar">
            <div class="navbar__search">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Hey {{ $data->username }}, search something">
                <i class="uil uil-microphone"></i>
            </div>

            <!-- <menu class="navbar__theme">
                <button class="navbar__theme-btn"><i class="uil uil-moon"></i></button>
                <button class="navbar_setting-btn"><i class="uil uil-setting"></i></button>
                <button class="navbar_notification-btn"><i class="uil uil-bell"></i></button>
                <button class="navbar_admin" id="profileButton">
                    <i class="uil uil-user"></i>
                </button>
            </menu> -->
        </nav>

        <div class="content">
            @yield('content')
        </div>
    </main>
    @stack('scripts')
</body>
</html>
