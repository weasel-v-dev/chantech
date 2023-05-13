<?php

namespace App\Http\Controllers;

use App\Http\Resources\TestimonialResource;
use App\Models\Review;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index(Request $request) {
        return response()->json([
            'testimonials' => TestimonialResource::collection(Review::paginate($request->total)),
            'count' => Review::count()
        ], 200);
    }
}
