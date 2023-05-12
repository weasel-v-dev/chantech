<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestimonialRequest;
use App\Models\Company;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Review;
use App\Models\Reviewer;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard');
    }

    public function distribution(TestimonialRequest $request) {

        collect($request->data)->map(function($el)  {
            Company::create([
                'name' => !empty($el['company']) ? $el['company'] : '',
                'description' => !empty($el['company_description']) ? $el['company_description'] : ''
            ]);

            Position::create([
                'name' => !empty($el['employees_position']) ? $el['employees_position'] : '',
                'token' => !empty($el['unique_employee_number']) ? $el['unique_employee_number'] : ''
            ]);

            Reviewer::create([
                'name' => !empty($el['reviewer']) ? $el['reviewer'] : '',
                'email' => !empty($el['email']) ? $el['email'] : ''
            ]);
        });

        collect($request->data)->map(function($el) {
            if(!empty($el['company'])) {
                $company = Company::where('name', $el['company'])->first();
            }
            if(!empty($el['employees_position'])) {
                $position = Position::where('name', $el['employees_position'])->first();
            }


            if(!empty($company->id) && !empty($position->id)) {
                Employee::create([
                    'name' => !empty($el->employee) ? $el->employee : '',
                    'company_id' => $company->id,
                    'position_id' => $position->id,
                ]);
            }
        });

        collect($request->data)->map(function($el) {
            $reviewer_id = Reviewer::where('name', !empty($el['reviewer']) ? $el['reviewer'] : '')->first();
            $employee_id = Employee::where('name', !empty($el['employee']) ? $el['employee'] : '')->first();

            if($reviewer_id && $employee_id) {
                Review::create([
                    'description' => !empty($el['review']) ? $el['review'] : '',
                    'rating' => !empty($el['rating']) ? $el['rating'] : '',
                    'reviewer_id' => $reviewer_id,
                    'employee_id' => $employee_id,
                ]);
            }
        });
    }
}
