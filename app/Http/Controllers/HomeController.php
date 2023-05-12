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
use mysql_xdevapi\Exception;

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

        $companyTerminateName = '';
        foreach (collect($request->data)->sortBy('company') as $el){
            var_dump($companyTerminateName);
            if(!empty($el['company']) && $companyTerminateName != $el['company']) {
                Company::create([
                    'name' => $el['company'],
                    'description' => !empty($el['company_description']) ? $el['company_description'] : ''
                ]);
                $companyTerminateName = $el['company'];
            }
        };

        $positionTerminateName = '';
        foreach (collect($request->data)->sortBy('employees_position') as $el){
            if(!empty($el['employees_position']) && $positionTerminateName != $el['employees_position']) {
                Position::create([
                    'name' => $el['employees_position'],
                ]);
                $positionTerminateName = $el['employees_position'];
            }
        };

        $reviewerTerminateName = '';
        foreach (collect($request->data)->sortBy('email') as $el){
            if(!empty($el['email']) && $reviewerTerminateName != $el['email']) {
                Reviewer::create([
                    'name' => !empty($el['reviewer']) ? $el['reviewer'] : '',
                    'email' => $el['email']
                ]);
                $reviewerTerminateName = $el['email'];
            }
        };

        collect($request->data)->map(function($el) {
            if(!empty($el['company'])) {
                $company = Company::where('name', $el['company'])->first();
            }
            if(!empty($el['employees_position'])) {
                $position = Position::where('name', $el['employees_position'])->first();
            }

            if(!empty($company->id) && !empty($position->id) && !empty($el['employee'])) {
                Employee::create([
                    'name' => $el['employee'],
                    'token' => !empty($el['unique_employee_number']) ? $el['unique_employee_number'] : '',
                    'company_id' => $company->id,
                    'position_id' => $position->id,
                ]);
            }
        });

        collect($request->data)->map(function($el) {
            $reviewer = Reviewer::where('name', !empty($el['reviewer']) ? $el['reviewer'] : '')->first();
            $employee = Employee::where('name', !empty($el['employee']) ? $el['employee'] : '')->first();

            if(!empty($reviewer->id) && !empty($employee->id)) {
                Review::create([
                    'description' => !empty($el['review']) ? $el['review'] : '',
                    'rating' => !empty($el['rating']) ? $el['rating'] : 0.0,
                    'reviewer_id' => $reviewer->id,
                    'employee_id' => $employee->id,
                ]);
            }
        });
    }
}
