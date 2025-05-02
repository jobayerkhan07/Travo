<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'TRAVO | Explore Thw World')</title>

    <!-- links -->

    <!-- links -->
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
                <ul>
                    <li><a href="#home" class="active">Home</a></li>
                    <li><a href="#About">About</a></li>
                    <li><a href="#Destination">Destination</a></li>
                    <li><a href="#Stays">Stays</a></li>
                    <li><a href="#Cars">Cars</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Image Showcase -->
<section class="home">
    <main>
        <div class="slide-container swiper">
            <div class="slide-content swiper-wrapper">
                <!-- Slide 1 -->
                <div class="overlay swiper-slide">
                    <img src="{{ asset('images/FIRST.jpeg') }}" alt="" />
                    <div class="img-overlay">
                        <h3 style="font-size: 20px; margin-bottom: 0.5rem; letter-spacing: 8px; color: #ffffff;">
                            Welcome to Travo
                        </h3>
                        <h1 style="font-size: 50px; margin-bottom: 1rem; letter-spacing: 8px; color: #ffffff;">
                            Explore The <br /> World
                        </h1>
                        <p style="font-size: 15px; margin-bottom: 1rem; color: #ffffff">
                            Discover new destinations, plan your perfect trip, and create unforgettable memories. <br />
                            Whether you're seeking adventure, relaxation, or cultural experiences <br />
                            – your journey starts here.
                        </p>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="overlay swiper-slide">
                    <img src="{{ asset('images/NYC ♡.jpeg') }}" alt="" />
                    <div class="img-overlay">
                        <h3 style="font-size: 20px; margin-bottom: 0.5rem; letter-spacing: 8px; color: #ffffff;">
                            Welcome to Travo
                        </h3>
                        <h1 style="font-size: 50px; margin-bottom: 1rem; letter-spacing: 8px; color: #ffffff;">
                            Explore The <br /> World
                        </h1>
                        <p style="font-size: 15px; margin-bottom: 1rem; color: #ffffff">
                            Discover new destinations, plan your perfect trip, and create unforgettable memories. <br />
                            Whether you're seeking adventure, relaxation, or cultural experiences <br />
                            – your journey starts here.
                        </p>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="overlay swiper-slide">
                    <img src="{{ asset('images/mountain.jpeg') }}" alt="" />
                    <div class="img-overlay">
                        <h3 style="font-size: 20px; margin-bottom: 0.5rem; letter-spacing: 8px; color: #ffffff;">
                            Welcome to Travo
                        </h3>
                        <h1 style="font-size: 50px; margin-bottom: 1rem; letter-spacing: 8px; color: #ffffff;">
                            Explore The <br /> World
                        </h1>
                        <p style="font-size: 15px; margin-bottom: 1rem; color: #ffffff">
                            Discover new destinations, plan your perfect trip, and create unforgettable memories. <br />
                            Whether you're seeking adventure, relaxation, or cultural experiences <br />
                            – your journey starts here.
                        </p>



                    </div>
                </div>
            </div>
        </div>
    </main>
</section>
<!-- search  bar -->
    <section class="search-bar">
    <div class="search-container">
        <label for="destination">Where heading to?</label>
            <input
              type="text"
              id="destination"
              placeholder="Enter destination"
              class="form-control"
            />

            <label for="duration">Duration</label>
            <select id="duration" class="form-control">
              <option value="1 Day">1 Day Tour</option>
              <option value="2-4 Days">2-4 Days Tour</option>
              <option value="6-8 Days">6-8 Days Tour</option>
              <option value="9+ Days">9+ Days Tour</option>
            </select>

            <label for="departure-date">Departure Date</label>
            <input type="date" id="departure-date" class="form-control" />

            <label for="return-date">Return Date</label>
            <input type="date" id="return-date" class="form-control" />
        <button class="search-btn">Search</button>
    </div>
</section>


<!-- about  start-->

<seletion class="about">
  <div class="container">
    <div class="about-content-wrapper">
      <div class="agency-left-side">
        <p class="heading-normal-txt">Why Choose Travo?</p>
        <h2 class="headings">DISCOVER THE <span>WORLD</span> WITH TRAVO</h2>
        <p class="lead">
          At Travo, we believe that every journey begins with a dream. Our
          mission is to make travel easy, exciting, and accessible for
          everyone. Whether you're planning a weekend getaway, a family
          vacation, or an adventure across the globe, we’re here to guide
          you every step of the way. From finding the best deals to
          discovering hidden gems, we’re passionate about helping you
          explore the world your way.
        </p>

        <p class="lead">
            Check out all the hotels and book according to your plan.Don't forgrt to book the car as well
        </p>



      </div>

      <div class="agency-right-side">
        <div class="img">
            <img src="{{ asset('images/about (2).jpeg') }}" alt="">
        </div>
      </div>
    </div>
  </div>
</seletion>

<!-- Start Button -->
<div class="start-journey">
  <a href="{{ route('user.auth') }}" class="start-btn">Start The Journey<i class='bx bx-right-arrow-alt'></i></a>
</div>


<!-- about end-->

<!-- about  end-->


<!-- Destination start -->
<section class="destinations">
  <h2>Top Destinations in Bangladesh</h2>
  <div class="destination-cards">

      <a href="{{ route('user.rooms.byLocation', ['location' => 'Cox Bazar']) }}" class="card">
          <div >
              <img src="{{ asset('images/Coxs Bazar.jpeg') }}" alt="Cox-bazar">
              <h3>Cox Bazar</h3>
          </div>
      </a>

      <a href="{{ route('user.rooms.byLocation', ['location' => 'Sundorban']) }}" class="card">
          <div >
              <img src="{{ asset('images/Sundorban.jpeg') }}" alt="Sundorban">
              <h3>Sundorban</h3>
          </div>
      </a>

      <a href="{{ route('user.rooms.byLocation', ['location' => 'Bandarban']) }}" class="card">
          <div>
              <img src="{{ asset('images/bandarban,.jpeg') }}" alt="Bandarban">
              <h3>Bandarban</h3>
          </div>
      </a>

      <a href="{{ route('user.rooms.byLocation', ['location' => 'Srimongal']) }}" class="card">
          <div >
              <img src="{{ asset('images/Srimangal,.jpeg') }}" alt="Srimongal">
              <h3>Srimongal</h3>
          </div>
      </a>

  </div>

  <div class="explore-more">
    <a href="{{ route('user.destinationexplore') }}" class="explore-btn">Explore More</a>
  </div>

</section>

<!-- Destination end -->


<!-- Hotel section start -->
<section class="hotels">
  <h2>High Rated Hotels</h2>
  <div class="hotel-cards">
      <div class="hotel-card">
          <img src="{{ asset('images/Intercontinental Dhaka Interior.jpeg') }}" alt="">
          <h3>Intercontinental Dhaka</h3>
          <p>Starting from 5000tk</p>
      </div>
      <div class="hotel-card">
          <img src="{{ asset('images/download (4).jpeg') }}" alt="">
          <h3>Royal Hotel</h3>
          <p>Starting from 9000tk</p>
      </div>
      <div class="hotel-card">
          <img src="{{ asset('images/eco resort.jpeg') }}" alt="">
          <h3>Eco Resort</h3>
          <p>Starting from 7000tk</p>
      </div>

      <div class="hotel-card">
          <img src="{{ asset('images/palace.jpeg') }}" alt="">
          <h3>Hotel Palace</h3>
          <p>Starting from 7000tk</p>
      </div>
  </div>

  <div class="explore-more">
    <a href="{{ route('user.hotelexplore') }}" class="explore-btn">Explore More</a>
  </div>
</section>
<!-- Hotel section end -->


<!-- car section start-->
<section class="car-rent">
  <h2>Car Rentals</h2>
  <div class="car-cards">
      <div class="car-card">
          <img src="{{ asset('images/car1.jpeg') }}" alt="">
          <h3>Private Car</h3>
          <p>4000tk per day</p>
      </div>
      <div class="car-card">
          <img src="{{ asset('images/micro.jpeg') }}" alt="">
          <h3>Micro Bus</h3>
          <p>8000tk per day</p>
      </div>
      <div class="car-card">
          <img src="{{ asset('images/minibus.jpeg') }}" alt="">
          <h3>Minibus</h3>
          <p>9000tk per day</p>
      </div>

      <div class="car-card">
          <img src="{{ asset('images/jeep.jpeg') }}" alt="">
          <h3>Jeep</h3>
          <p>9000tk per day</p>
      </div>
  </div>

  <div class="explore-more">
    <a href="{{ route('user.carexplore') }}" class="explore-btn">Explore More</a>
  </div>
</section>

<!-- Footer Section -->
<footer>
  <div class="footer-content">
      <div class="destinations-footer">
          <h3>Others</h3>
          <h4 style="font-size: 15px; margin-bottom: 1rem; color: #ffffff">Join Us & Start Renting Your Property</h4>
          <ul>
              <li><a href="{{ route('vendor.register') }}">ADD YOUR PROPERTY</a></li>
          </ul>
      </div>
      <div class="copyright-footer">
          <h3><i class='bx bx-copyright'></i>All the copy rights reserved to Jobayer & Samantha</h3>

      </div>
  </div>
</footer>


   <!-- Script-->
   <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/swiper.js') }}"></script>
</body>
</html>
