<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewerRequest;
use Illuminate\Http\Request;

class ReviewerController extends Controller
{
    public function create(ReviewerRequest $request) {
        dd($request->all());
    }
}
