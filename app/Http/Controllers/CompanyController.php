<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Http\Requests\ReviewRequest;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function create(CompanyRequest $request) {
        dd($request->all());
//        Company::create($request->map(function ($item) {
//            return [
//                'name' => $item['company'],
//                'description' => $item['company_description']
//            ];
//        }));

    }
}
