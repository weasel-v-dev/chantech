<?php


namespace App\Services\Testimonials;


use App\Models\Position;
use Illuminate\Support\Facades\Log;

class PositionService extends BaseService implements ITestimonial
{
    private $data;

    public function __construct($data = [])
    {
        $this->data = $data;
    }

    public function createMassive() {
        $positionTerminateName = '';
        $filteredData = [];
        $sortedData = collect($this->data)->sortBy('employees_position');
        foreach ($sortedData as $i => $el){
            if(!empty($el['employees_position']) && $positionTerminateName != $el['employees_position']) {
               $filteredData[] = [
                   'name' => $el['employees_position'],
                   'created_at' => now()->toDateTimeString(),
                   'updated_at' => now()->toDateTimeString()
               ];
               $positionTerminateName = $el['employees_position'];
            }
            $this->provideConnection($i);
        }

        $chunks = array_chunk($filteredData, 5);

        try {
            foreach ($chunks as $chunk){
                Position::insert($chunk);
            }
        } catch (\Exception $e) {
            Log::error('Position' . $e);
        }
    }

    public function removeMassive() {
        $position = Position::all();
        foreach ($position as $i => $item) {
            $item->delete();
            $this->provideConnection($i);
        }
    }
}
