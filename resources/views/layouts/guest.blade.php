<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Styles -->
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
<header >
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-md d-flex">
            <a class="navbar-brand" href="/"><img src="{{  asset('img/icons/logo-main.svg') }}" class="" alt="logo"></a>
            <div class="me-auto ms-3">
                <div class="small">Need Help?</div>
                <div class="large"><a href="tel:5145439936">(514) 543-9936</a></div>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="ms-auto navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link fw-semibold black" href="#">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold black" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold black" href="#">Book now</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold black" href="#">Shop</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link fw-semibold black" href="#">Blog</a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link fw-semibold black" href="#">Contact</a>
                    </li>
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <a class="nav-link fw-semibold black" href="{{ url('/dashboard') }}">Home</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link fw-semibold black" href="{{ url('/login') }}">Log in</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a href="{{ route('register') }}" class="nav-link black fw-semibold">Register</a>
                                </li>
                            @endif
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>
    @yield('content')
<footer class="footer gray-bg pt-3 pb-3 pt-lg-5 pb-lg-5">
    <div class="container-md">
        <div class="row">
            <div class="col-6 col-lg-3">
                <h4 class="large mb-3 mb-xl-4">Departments</h4>
                <ul>
                    <li class=""><a href="#">Medical</a></li>
                    <li class=""><a href="#">Pharmaceuticals</a></li>
                    <li class=""><a href="#">Medical Equipment</a></li>
                </ul>
            </div>
            <div class="col-6 col-lg-3">
                <h4 class="large mb-3 mb-xl-4">Quick Links</h4>
                <ul>
                    <li class=""><a href="#">What do we do?</a></li>
                    <li class=""><a href="#">Our expertise</a></li>
                    <li class=""><a href="#">Request an Appointment</a></li>
                    <li class=""><a href="#">Book with a Specialist</a></li>
                </ul>
            </div>
            <div class="col-6 col-lg-3 ">
                <h4 class="large mb-3 mb-xl-4">Head Office</h4>
                <ul class="ps-3">
                    <li class=""><a target="_blank" href="https://goo.gl/maps/yVj7dQDZv7JLRvoN9"><span class="mdi mdi-marker"></span> 4517 Washington Ave. Manchester, Kentucky 39495</a></li>
                    <li class=""><a href="mailto:darrell@mail.com"><span class="mdi mdi-email"></span> darrell@mail.com</a></li>
                    <li class=""><a href="tel:+6715550110"><span class="mdi mdi-phone"></span> (671) 555-0110</a></li>
                </ul>
            </div>
            <div class="col-6 col-lg-3">
                <img src="{{ asset('img/icons/logo.svg') }}" class="img-fluid" alt="logo">
                <p class=" mt-3 mt-xl-4">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras blandit tincidunt ut sed. Velit euismod integer convallis ornare eu.
                </p>
            </div>
            <div class="col-6 col-lg-3">
                <p class=" mb-0">
                    &copy;<?= date("Y") ?> All Rights Reserved
                </p>
            </div>
        </div>
    </div>
</footer>
</body>
</html>
