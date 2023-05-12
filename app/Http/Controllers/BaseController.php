<?php

namespace App\Http\Controllers;


use App\Services\Testimonials\Service;

class BaseController extends Controller
{
    protected $testimonial;

    public function __construct(Service $testimonial)
    {
        $this->testimonial = $testimonial;
    }
}
