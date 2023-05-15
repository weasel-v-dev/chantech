<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestimonialRequest;
use App\Services\Testimonials\AggregatorService;

class HomeController extends BaseController
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AggregatorService $testimonial)
    {
        parent::__construct($testimonial);
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
            'status' => $result
        ], 200);
    }
}
