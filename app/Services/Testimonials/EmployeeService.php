<?php


namespace App\Services\Testimonials;


use App\Models\Company;
use App\Models\Employee;
use App\Models\Position;
use Illuminate\Support\Facades\Log;

class EmployeeService extends BaseService implements ITestimonial
{
    private $data;

    public function __construct($data = [])
    {
        $this->data = $data;
    }

    public function createMassive() {
        $employeeTerminateName = '';
        $filteredData = [];
        foreach (collect($this->data)->sortBy('employee') as $i => $el){
            if(!empty($el['company'])) {
                $company = Company::where('name', $el['company'])->first();
            }
            if(!empty($el['employees_position'])) {
                $position = Position::where('name', $el['employees_position'])->first();
            }

            if(!empty($company->id) && !empty($position->id) && !empty($el['employee']) && $employeeTerminateName != $el['employee']) {

                $filteredData[] = [
                    'name' => $el['employee'],
                    'token' => !empty($el['unique_employee_number']) ? $el['unique_employee_number'] : '',
                    'position_id' => $position->id,
                    'company_id' => $company->id,
                    'created_at' => now()->toDateTimeString(),
                    'updated_at' => now()->toDateTimeString()
                ];
                $employeeTerminateName = $el['employee'];
            }
            $this->provideConnection($i);
        }

        $chunks = array_chunk($filteredData, 10000);

        try {
            foreach ($chunks as $chunk) {
                Employee::insert($chunk);
            }
        } catch (\Exception $e) {
            Log::error('Company' . $e);
        }
    }

    public function removeMassive() {
        $employee = Employee::all();
        foreach ($employee as $i => $item) {
            $item->delete();
            $this->provideConnection($i);
        }
    }
}
