<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />


    <!-- favicon -->
    <link rel="shortcut icon" href="images/topicon.png" />
    <link
        href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
        rel="stylesheet"
    />
    <link rel="stylesheet" href="{{ asset('css/vendor-style.css') }}" />
    <title>Travo | Vendor Login</title>
</head>
<body class="vendor-auth">
<div class="wrapper-vendor">
    <div class="heading-container">
        <h1
            style="
            color: #1b1b1b;
            font-size: 2rem;
            font-weight: 800;
            text-transform: uppercase;
          "
        >
            TRA<span style="color: #ffd700; font-size: 3rem; font-weight: 900"
            >V</span
            >O | SIGN IN
        </h1>
        <h2 style="color: #1f1919">Welcome back, Vendor!!</h2>
        <h4 style="color: #1f1919">
            Log in and start providing your services today!
        </h4>
    </div>

    <!-- Login Form -->
    <form action="{{ route('vendor.login') }}" method="POST" class="login-container-ven" id="login">
        @csrf
        @if(session('fail'))
            <div style="color: red; margin-bottom: 20px; text-align: center;">
                {{ session('fail') }}
            </div>
        @endif

        @if($errors->any())
            <div style="color: red; margin-bottom: 20px; text-align: center;">
                <ul style="list-style: none; padding: 0;">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="input-box-ven">
            <input type="email" name="email" class="input-field-ven" placeholder="Email" required />
            <i class="bx bx-user"></i>
        </div>

        <div class="input-box-ven">
            <input type="password" name="password" class="input-field-ven" placeholder="Password" required autocomplete="off" />
            <i class="bx bx-lock-alt"></i>
        </div>

        <div class="input-box-ven submit-box-ven">
            <button type="submit" class="submit-ven">Sign In</button>
        </div>

        <div class="two-col-ven">
            <div class="one-ven">
                <input type="checkbox" id="login-check" name="remember" />
                <label for="login-check">Remember Me!</label>
            </div>

            <div class="two-ven">
                <label><a href="#">Forgot Password?</a></label>
            </div>
        </div>
    </form>
    <!-- End Login Form -->

    <div class="bottom2">
        <span>
            Don't have an account?
          <a href="{{ route('vendor.showRegister') }}">Sign Up</a>
        </span>
    </div>
</div>
</body>
</html>
