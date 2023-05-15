<?php

namespace App\Http\Controllers;

use App\Http\Resources\TestimonialResource;
use App\Models\Review;
use App\Services\Testimonials\AggregatorService;
use Illuminate\Http\Request;

class TestimonialController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AggregatorService $testimonial)
    {
        parent::__construct($testimonial);
        $this->middleware('auth', [
            'except' => ['index']
        ]);
    }

    public function index(Request $request) {
        return response()->json([
            'testimonials' => TestimonialResource::collection(Review::paginate($request->total)),
            'count' => Review::count()
        ], 200);
    }

    public function check() {
        return response()->json([
            'status' => Review::exists()
        ], 200);
    }

    public function clean() {
        $status = $this->testimonial->removeTestimonials();

        return response()->json([
            'status' => $status
        ], 200);
    }
}
