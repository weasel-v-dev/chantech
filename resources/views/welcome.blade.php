@extends('layouts.guest')

@section('content')
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
        <section class=" kh-bg py-3 mt-3 mt-lg-5 py-lg-5">
            <div class="container-md">
                <h2 class="text-center">Testimonials</h2>
                <div class="d-flex mt-3 flex-wrap">
                    <div id="app" class="w-100">
                        <testimonial></testimonial>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
