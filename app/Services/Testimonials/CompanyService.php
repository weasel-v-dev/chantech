<?php


namespace App\Services\Testimonials;


use App\Models\Company;
use Illuminate\Support\Facades\Log;

class CompanyService
{
    private $data;

    public function __construct($data)
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
            if($i  % 50  == 0) {
                set_time_limit(30);
            }
        };
    }
}
