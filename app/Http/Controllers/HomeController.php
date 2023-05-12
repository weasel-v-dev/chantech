<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestimonialRequest;
use App\Services\Testimonials\Service;

class HomeController extends BaseController
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Service $service)
    {
        parent::__construct($service);
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard');
    }

    public function distribution(TestimonialRequest $request) {

        $result = $this->testimonial->saveTestimonials($request->data);

        return response()->json([
            'message' => $result
        ], 200);
    }
}
