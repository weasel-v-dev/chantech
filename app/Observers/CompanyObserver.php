<?php

namespace App\Observers;

use App\Models\Company;

class CompanyObserver
{
    public function deleting(Company $company) {
        foreach ($company->employees as $i => $employee) {
            $employee->delete();
            if($i  % 50  == 0) {
                set_time_limit(30);
            }
        }
    }
}
