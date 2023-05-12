<?php


namespace App\Services\Testimonials;


use App\Models\Reviewer;
use Illuminate\Support\Facades\Log;

class ReviewerService
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function createMassive() {
        $reviewerTerminateName = '';
        foreach (collect($this->data)->sortBy('email') as $i => $el){
            if(!empty($el['email']) && $reviewerTerminateName != $el['email']) {
                try {
                    Reviewer::create([
                        'name' => !empty($el['reviewer']) ? $el['reviewer'] : '',
                        'email' => $el['email']
                    ]);
                } catch (\Exception $e) {
                    Log::error('Reviewer' . $e);
                }
                $reviewerTerminateName = $el['email'];
            }
            if($i  % 50  == 0) {
                set_time_limit(30);
            }
        }
    }
}
