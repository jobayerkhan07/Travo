<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- favicon -->
    <link rel="shortcut icon" href="images/topicon.png" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('css/vendor-style.css') }}" />
    <script src="{{ asset('js/user-auth-form-style-script.js') }}"></script>
    <title>Travo | Login & Registration</title>
</head>

<body class="customer-auth">
<div class="wrapper-customer">
    <nav class="nav">
        <div class="nav-logo">
            <h3 style="color: #ffffff; font-size: 28px; font-weight: 800">
                TRA<span style="color: #ffd700; font-size: 29px; font-weight: 900">V</span>O
            </h3>
        </div>

        <!-- <div class="nav-menu">
            <ul>
                <li><a href="#" class="link active">Home</a></li>
                <li><a href="#" class="link">Stays</a></li>
                <li><a href="#" class="link">Car Rental</a></li>
                <li><a href="#" class="link">About</a></li>
            </ul>
        </div> -->

        <div class="nav-button">
            <button class="btn white-btn" id="loginBtn" onclick="login()">Sign In</button>
            <button class="btn" id="registerBtn" onclick="register()">Sign Up</button>
        </div>

        <div class="nav-menu-btn">
            <i class="bx bx-menu" onclick="myMenuFunction()"></i>
        </div>
    </nav>

    <!-- Form Container -->
    <div class="form-box">
        <!-- Login Form -->
        <form class="login-container" id="login" method="post" action="{{ route('user.login.submit') }}">
            @csrf
            <div class="top">
                <header>Log in</header>
            </div>

            <div class="input-box">
                <input type="email" name="email" class="input-field" placeholder="Email" required />
                <i class="bx bx-envelope"></i>
            </div>

            <div class="input-box">
                <input type="password" name="password" class="input-field" placeholder="Password" required />
                <i class="bx bx-lock-alt"></i>
            </div>

            <div class="input-box submit-box">
                <input type="submit" class="submit" value="Sign In" />
            </div>

            <div class="two-col">
                <div class="one">
                    <input type="checkbox" id="login-check" name="remember" />
                    <label for="login-check">Remember Me!</label>
                </div>

                <div class="two">
                    <label><a href="#">Forgot Password?</a></label>
                </div>
            </div>
        </form>

        <!-- Registration Form -->
        <form class="register-container" id="register" method="post" action="{{ route('user.store.submit') }}">
            @csrf
            <div class="top">
                <header>Sign Up</header>
            </div>
            @if(Session::has('success'))
                <div>
                    {{Session::get('success')}}
                </div>
            @endif

            @if(Session::has('fail'))
                <div>
                    {{Session::get('fail')}}
                </div>
            @endif
            <div class="two-forms">
                <div class="input-box">
                    <input type="text" name="firstname" class="input-field" placeholder="Firstname" required />
                    <i class="bx bx-user"></i>
                </div>

                <div class="input-box">
                    <input type="text" name="lastname" class="input-field" placeholder="Lastname" required />
                    <i class="bx bx-user"></i>
                </div>
            </div>

            <div class="input-box">
                <input type="email" name="email" class="input-field" placeholder="Email" required />
                <i class="bx bx-envelope"></i>
            </div>

            <div class="input-box">
                <input type="tel" name="phone_number" class="input-field" placeholder="Phone Number" required />
                <i class="bx bx-phone"></i>
            </div>

            <div class="input-box">
                <input type="password" name="password" class="input-field" placeholder="Password" required />
                <i class="bx bx-lock-alt"></i>
            </div>

            <div class="input-box submit-box">
                <input type="submit" class="submit" value="Register" />
            </div>

            <div class="two-col">
                <div class="one">
                    <input type="checkbox" id="register-check" />
                    <label for="register-check">Remember Me!</label>
                </div>

                <div class="two">
                    <label><a href="#">Terms & conditions</a></label>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>
