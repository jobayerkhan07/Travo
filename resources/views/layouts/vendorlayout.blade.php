<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TRAVO')</title>


    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('images/topicon.png') }}" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/vendorCSS.css') }}">
    <script src="{{ asset('js/vendor.js') }}"></script>
</head>

<body>

    <header>
        <nav>

            <div class="nav-logo">
                <a href="{{ route('vendor.main') }}" style="text-decoration: none;">
                    <h3 style="color: #ffffff; font-size: 32px; font-weight: 800;">
                        TRA<span style="color: #ffd700; font-size: 29px; font-weight: 900;">V</span>O
                    </h3>
                </a>
            </div>


            <div class="nav-link">

                <a href=""><button>Profile<i class='bx bx-user'></i></button></a>
                {{-- <a href="{{ route('vendor.logout') }}"><button>logout</button></a> --}}
                <form action="{{ route('vendor.logout') }}" method="POST"
      class="inline-block bg-transparent shadow-none rounded-none"
      style="background:transparent;box-shadow:none;border:0;">
    @csrf

    <button type="submit"
            class="flex items-center gap-1
                   text-white hover:text-yellow-300
                   p-0 m-0 bg-transparent border-0 focus:outline-none">
        Logout
        <i class="uil uil-signout"></i>
    </button>
</form>



            </div>

        </nav>

<!-- layouts -->
<div class="content">
        @yield('content')
    </div>
    </header>




</body>
</html>
