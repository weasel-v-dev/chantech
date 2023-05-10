<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use Illuminate\Http\Request;

class ReviewController extends BaseController
{
    public function create(ReviewRequest $request) {
        dd($request->all());
    }
}
