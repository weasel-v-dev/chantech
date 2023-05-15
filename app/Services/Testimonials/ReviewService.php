<?php


namespace App\Services\Testimonials;


use App\Models\Employee;
use App\Models\Review;
use App\Models\Reviewer;

class ReviewService extends BaseService
{
    private $data;

    public function __construct($data = [])
    {
        $this->data = $data;
    }

    public function createMassive() {
        collect($this->data)->map(function($el, $i) {
            $reviewer = Reviewer::where('name', !empty($el['reviewer']) ? $el['reviewer'] : '')->first();
            $employee = Employee::where('name', !empty($el['employee']) ? $el['employee'] : '')->first();

            if(!empty($reviewer->id) && !empty($employee->id)) {
                $reviewer->reviews()->create([
                    'description' => !empty($el['review']) ? $el['review'] : '',
                    'rating' => !empty($el['rating']) ? $el['rating'] : 0.0,
                    'employee_id' => $employee->id,
                ]);
            }
            $this->provideConnection($i);
        });
    }

    public function removeMassive() {
        $review = Review::all();
        foreach ($review as $i => $item) {
            $item->delete();
            $this->provideConnection($i);
        }
    }
}
