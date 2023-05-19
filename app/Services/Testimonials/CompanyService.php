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

                $companyTerminateName = $el['company'];
            }
            $this->provideConnection($i);
        }

        $chunks = array_chunk($filteredData, 5000);

        try {
            foreach ($chunks as $chunk) {
                Company::insert($chunk);
            }
        } catch (\Exception $e) {
            Log::error('Company' . $e);
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
