<?php


namespace App\Services\Testimonials;


use App\Models\Position;
use Illuminate\Support\Facades\Log;

class PositionService extends BaseService
{
    private $data;

    public function __construct($data = [])
    {
        $this->data = $data;
    }

    public function createMassive() {
        $positionTerminateName = '';
        foreach (collect($this->data)->sortBy('employees_position') as $i => $el){
            if(!empty($el['employees_position']) && $positionTerminateName != $el['employees_position']) {
                try {
                    Position::create([
                        'name' => $el['employees_position'],
                    ]);
                } catch (\Exception $e) {
                    Log::error('Position' . $e);
                }
                $positionTerminateName = $el['employees_position'];
            }
            $this->provideConnection($i);
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
