<?php


namespace App\Services\Testimonials;


use App\Models\Company;
use Illuminate\Support\Facades\Log;

class CompanyService extends BaseService implements ITestimonial
{
    private $data;

    public function __construct($data = [])
    {
        $this->data = $data;
    }

    public function createMassive() {
        $companyTerminateName = '';
        $filteredData = [];
        $data = collect($this->data)->sortBy('company');

        foreach ($data as $i => $el){
            if(!empty($el['company']) && $companyTerminateName != $el['company']) {
                $filteredData[] = [
                    'name' => $el['company'],
                    'description' => !empty($el['company_description']) ? $el['company_description'] : '',
                    'created_at' => now()->toDateTimeString(),
                    'updated_at' => now()->toDateTimeString()
                ];

                if($i % 10 === 0) {
                    try {
                        Company::insert($filteredData);
                        $filteredData = [];
                    } catch (\Exception $e) {
                        Log::error('Company' . $e);
                    }
                }

                $companyTerminateName = $el['company'];
            }
            $this->provideConnection($i);
        }
        if(count($filteredData)) {
            try {
                Company::insert($filteredData);
            } catch (\Exception $e) {
                Log::error('Company' . $e);
            }
        }
    }

    public function removeMassive() {
        $companies = Company::all();
        foreach ($companies as $i => $item) {
            $item->delete();
            $this->provideConnection($i);
        }
    }
}
