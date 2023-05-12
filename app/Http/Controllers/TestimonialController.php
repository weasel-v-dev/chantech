<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index() {
        foreach (Employee::all() as $item) {
            dd(
                $item->name,
                $item->getCompany->name,
                $item->getPosition->name,
            );
        }
        return view('welcome');
    }
}
