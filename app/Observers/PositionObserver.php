<?php

namespace App\Observers;

use App\Models\Company;
use App\Models\Position;

class PositionObserver
{
    public function deleting(Position $position) {
        foreach ($position->employee as $i => $employee) {
            $employee->delete();
            if($i  % 50  == 0) {
                set_time_limit(30);
            }
        }
    }
}
