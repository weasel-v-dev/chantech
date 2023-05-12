<?php


namespace App\Services\Testimonials;


use App\Models\Employee;
use App\Models\Review;
use App\Models\Reviewer;

class ReviewService
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function createMassive() {
        collect($this->data)->map(function($el, $i) {
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
            if($i  % 50  == 0) {
                set_time_limit(30);
            }
        });
    }
}
