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
    <title>Travo | Vendor Registration</title>
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
            >O | SIGN UP
        </h1>
        <h2 style="color: #1f1919">Welcome, Vendor!!</h2>
        <h4 style="color: #1f1919">
            Join us and start providing your services today!
        </h4>
    </div>

    <form class="register-container-ven" id="register" method="POST" action="{{ route('vendor.register') }}">
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

        <div class="form-box-ven">
            <div class="two-forms-ven">
                <div class="input-box-ven">
                    <input type="text" class="input-field-ven" name="firstname" placeholder="Firstname" required />
                    <i class="bx bx-user"></i>
                </div>

                <div class="input-box-ven">
                    <input type="text" class="input-field-ven" name="lastname" placeholder="Lastname" required />
                    <i class="bx bx-user"></i>
                </div>
            </div>

            <div class="input-box-ven">
                <input type="email" class="input-field-ven" name="email" placeholder="Email" required />
                <i class="bx bx-envelope"></i>
            </div>

            <div class="input-box-ven">
                <input type="tel" class="input-field-ven" name="phone" placeholder="Phone number" required />
                <i class="bx bx-phone"></i>
            </div>

            <div class="input-box-ven">
                <input type="password" class="input-field-ven" name="password" placeholder="Password" required
                       title="Password must be at least 6 characters." />
                <i class="bx bx-lock-alt"></i>
            </div>

            <div class="input-box-ven">
                <input type="password" class="input-field-ven" name="password_confirmation" placeholder="Confirm Password" required />
                <i class="bx bx-lock-alt"></i>
            </div>

            <div class="service-selection">
                Services:
                <label>
                    <input type="radio" name="service" value="hotel" checked />
                    Hotel
                </label>
                <label>
                    <input type="radio" name="service" value="car" />
                    Car
                </label>
                <label>
                    <input type="radio" name="service" value="both"/>
                    Both
                </label>
            </div>

            <div class="input-box-ven submit-box-ven">
                <button type="submit" class="submit-ven">Register</button>
            </div>

            <div class="two-col-ven">
                <div class="one-ven">
                    <input type="checkbox" id="register-check" name="remember" />
                    <label for="register-check">Remember Me!</label>
                </div>

                <div class="two-ven">
                    <label><a href="#">Terms & conditions</a></label>
                </div>
            </div>

            <div class="bottom">
            <span>Already have an account?
                <a href="{{ route('vendor.showLogin') }}">Login</a>
            </span>
            </div>
        </div>
    </form>

</div>
</body>
</html>
