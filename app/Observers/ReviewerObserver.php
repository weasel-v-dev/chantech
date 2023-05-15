<?php

namespace App\Observers;

use App\Models\Reviewer;

class ReviewerObserver
{
    public function deleting(Reviewer $reviewer) {
        foreach ($reviewer->review as $i => $review) {
            $review->delete();
            if($i  % 50  == 0) {
                set_time_limit(30);
            }
        }
    }
}
