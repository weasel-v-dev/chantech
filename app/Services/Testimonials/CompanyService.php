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

        foreach (collect($this->data)->sortBy('company') as $i => $el){
            if(!empty($el['company']) && $companyTerminateName != $el['company']) {
                try {
                    Company::create([
                        'name' => $el['company'],
                        'description' => !empty($el['company_description']) ? $el['company_description'] : ''
                    ]);
                } catch (\Exception $e) {
                    Log::error('Company' . $e);
                }
                $companyTerminateName = $el['company'];
            }
            $this->provideConnection($i);
        };
    }

    public function removeMassive() {
        $companies = Company::all();
        foreach ($companies as $i => $item) {
            $item->delete();
            $this->provideConnection($i);
        }
    }
}
