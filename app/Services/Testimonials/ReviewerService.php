<?php


namespace App\Services\Testimonials;


use App\Models\Reviewer;
use Illuminate\Support\Facades\Log;

class ReviewerService extends BaseService implements ITestimonial
{
    private $data;

    public function __construct($data = [])
    {
        $this->data = $data;
    }

    public function createMassive() {
        $filteredData = [];
        foreach ($this->data as $i => $el){
            if(!empty($el['email'])) {
                $filteredData[] = [
                    'name' => !empty($el['reviewer']) ? $el['reviewer'] : '',
                    'email' => $el['email'],
                    'created_at' => now()->toDateTimeString(),
                    'updated_at' => now()->toDateTimeString()
                ];
            }
            $this->provideConnection($i);
        }

        $chunks = array_chunk($filteredData, 10000);

        try {
            foreach ($chunks as $chunk) {
                Reviewer::insert($chunk);
            }
        } catch (\Exception $e) {
            Log::error('Reviewer' . $e);
        }
    }

    public function removeMassive() {
        $reviewer = Reviewer::all();
        foreach ($reviewer as $i => $item) {
            $item->delete();
            $this->provideConnection($i);
        }
    }
}
