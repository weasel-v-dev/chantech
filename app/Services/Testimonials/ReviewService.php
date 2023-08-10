<?php


namespace App\Services\Testimonials;


use App\Models\Employee;
use App\Models\Review;
use App\Models\Reviewer;
use Illuminate\Support\Facades\Log;

class ReviewService extends BaseService implements ITestimonial
{
    private $data;

    public function __construct($data = [])
    {
        $this->data = $data;
    }

    public function createMassive() {
        $filteredData = [];
        foreach ($this->data as $i => $el){
            $reviewer = Reviewer::where('name', !empty($el['reviewer']) ? $el['reviewer'] : '')->first();
            $employee = Employee::where('name', !empty($el['employee']) ? $el['employee'] : '')->first();

            if(!empty($reviewer->id) && !empty($employee->id)) {
                $filteredData[] = [
                    'description' => !empty($el['review']) ? $el['review'] : '',
                    'rating' => !empty($el['rating']) ? $el['rating'] : 0.0,
                    'employee_id' => $employee->id,
                    'reviewer_id' => $reviewer->id,
                    'created_at' => now()->toDateTimeString(),
                    'updated_at' => now()->toDateTimeString()
                ];

                if($i % 10000 === 0) {
                    try {
                        Review::insert($filteredData);
                        $filteredData = [];
                    } catch (\Exception $e) {
                        Log::error('Reviewer' . $e);
                    }
                }
            }

            $this->provideConnection($i);
        }

        if(count($filteredData)) {
            try {
                Review::insert($filteredData);
            } catch (\Exception $e) {
                Log::error('Review' . $e);
            }
        }
    }

    public function removeMassive() {
        $review = Review::all();
        foreach ($review as $i => $item) {
            $item->delete();
            $this->provideConnection($i);
        }
    }
}
