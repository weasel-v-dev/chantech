<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

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
                        <div class="large">(514) 543-9936</div>
                    </div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="ms-auto navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Services</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Book now</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Shop</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="#">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Contact</a>
                            </li>
                        </ul>
                        @if (Route::has('login'))
                            <div class="hidden fixed top-0 right-0 sm:block">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                                @else
                                    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                                    @endif
                                @endauth
                            </div>
                        @endif
                    </div>
                </div>
            </nav>
        </header>
        <main class="pt-3 pt-lg-5">
            <section class="container-md ">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="d-flex " >
                            <div class="overflow-hidden">
                                <img src="{{ asset('/img/beautiful.jpg') }}" class="img w-100 h-100" alt="">
                            </div>
                            <div class="p-3 kh-bg">
                                <div class="">
                                    <p class="fw-bold blue">Pharmaceuticals</p>
                                    <h1 class="large fw-semibold">A Sure Way To Get Rid Of Your Back Ache Problem</h1>
                                    <p>
                                        If you have tried everything, but still seem to suffer from snoring, don’t give up.
                                        Before turning to surgery, consider shopping for anti-snore devices. These products
                                        do not typically require a prescription, are economically priced and may just be the
                                        answer that you are looking for. However, as is the case when shopping for anything,
                                        there are a lot of anti-snore devices out there and…
                                    </p>
                                    <div class="d-flex small">
                                        <div class="me-5">28 Feb <span class="blue">Jim Sullivan</span></div>
                                        <div ><span class="mdi mdi-clock align-top"></span> 6 min read</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <h2 class="big fw-bold">Our Latest News</h2>
                        <a href="#" class="p-3 news white-color mb-2" style="background-image: url('{{asset('/img/desk.jpg')}}');">
                            <h3 class="middle fw-semibold">Basic Swedish Back Massage Techniques</h3>
                            <div class="small">28 Feb 2021</div>
                        </a>
                        <a href="#" class="p-3 news white-color mb-2" style="background-image: url('{{asset('/img/desk.jpg')}}');">
                            <h3 class="middle fw-semibold">How to Learn Coding for Beginners</h3>
                            <div class="small">28 Feb 2021</div>
                        </a>
                        <a href="#" class="p-3 news white-color" style="background-image: url('{{asset('/img/luxury.jpg')}}');">
                            <h3 class="middle fw-semibold">Google’s Influence Over Think Tanks</h3>
                            <div class="small">28 Feb 2021</div>
                        </a>
                    </div>
                </div>
            </section>
            <section class="container-md kh-bg pt-3 mt-3 mt-lg-5 pt-lg-5">
                <h2 class="text-center">Testimonials</h2>
                <div class="d-flex mt-3 flex-wrap">
                    <div id="app">
                        <testimonial></testimonial>
                    </div>
                </div>
            </section>
        </main>
        <footer class="footer gray-bg pt-3 pb-3 pt-lg-5 mt-3 pb-lg-5 mt-lg-5">
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
                            <li class="middle"><a target="_blank" href="https://goo.gl/maps/yVj7dQDZv7JLRvoN9"><span class="mdi mdi-marker"></span> 4517 Washington Ave. Manchester, Kentucky 39495</a></li>
                            <li class="middle"><a href="mailto:darrell@mail.com"><span class="mdi mdi-email"></span> darrell@mail.com</a></li>
                            <li class="middle"><a href="tel:+6715550110"><span class="mdi mdi-phone"></span> (671) 555-0110</a></li>
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
{{--        <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>--}}
    </body>
</html>
