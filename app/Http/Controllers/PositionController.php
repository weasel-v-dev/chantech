<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PositionRequest;
use App\Http\Requests\ReviewerRequest;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function create(PositionRequest $request) {
        dd($request->all());
    }
}
