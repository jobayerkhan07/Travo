<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'TRAVO | Explore Thw World')</title>

    <!-- favicon -->
    <link rel="shortcut icon" href="images/topicon.png" />
    <!-- icon -->
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    />
    <!-- for slider -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />
    <!-- css -->
    <link rel="stylesheet" href="{{ asset('css/customerCSS.css') }}" />
    <link rel="stylesheet" href="responsive/responsiveCSS.css" />
      @vite(['resources/css/app.css', 'resources/js/app.js'])
      @stack('scripts')
  </head>
  <body>


  <header>
        <div class="container">
            <nav>
                <div class="logo">
                    <h1 style="color: #ffffff; font-size: 1.5rem; font-weight: 800; text-transform: uppercase;">
                        TRA<span style="color: #ffd700; font-size: 2rem; font-weight: 900">V</span>O
                    </h1>
                </div>

                <div>
                <div class="nav-link">

                <a href=""><button>Profile<i class='bx bx-user'></i></button></a>
                <a href="{{ route('vendor.logout') }}"></a><button>logout</button></a>

            </div>
                </div>
            </nav>
        </div>
    </header>




<!-- layouts -->
<div class="content">
        @yield('content')
    </div>
    </header>


    </body>
</html>
