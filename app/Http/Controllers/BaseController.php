<?php

namespace App\Http\Controllers;


use App\Services\Testimonials\AggregatorService;

class BaseController extends Controller
{
    protected $testimonial;

    public function __construct(AggregatorService $testimonial)
    {
        $this->testimonial = $testimonial;
    }
}
