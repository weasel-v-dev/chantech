<?php

namespace App\Observers;


use App\Models\Employee;

class EmployeeObserver
{
    public function deleting(Employee $employee) {
        foreach ($employee->review as $i => $review) {
            $review->delete();
            if($i  % 50  == 0) {
                set_time_limit(30);
            }
        }
    }
}
