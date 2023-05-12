<?php


namespace App\Services\Testimonials;


use App\Models\Company;
use App\Models\Employee;
use App\Models\Position;

class EmployeeService
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function createMassive() {
        collect($this->data)->map(function($el, $i) {
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
            if($i  % 50  == 0) {
                set_time_limit(30);
            }
        });
    }
}
