<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\Testimonials\Company\Service;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public $service;


    public function __construct(Service $service)
    {
        $this->service = $service;
    }
}
