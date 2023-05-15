<?php


namespace App\Services\Testimonials;


use App\Models\Company;
use App\Models\Employee;
use App\Models\Position;

class EmployeeService extends BaseService
{
    private $data;

    public function __construct($data = [])
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
            $this->provideConnection($i);
        });
    }

    public function removeMassive() {
        $employee = Employee::all();
        foreach ($employee as $i => $item) {
            $item->delete();
            $this->provideConnection($i);
        }
    }
}
