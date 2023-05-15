<?php


namespace App\Services\Testimonials;


class BaseService
{
    protected function provideConnection($i) {
        if($i  % 50  == 0) {
            set_time_limit(30);
        }
    }
}
