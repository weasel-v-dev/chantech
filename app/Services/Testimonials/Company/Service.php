<?php


namespace App\Services\Testimonials\Company;


use App\Models\Company;

class Service
{
    public static function create($request) {
        Company::create($request->map(function ($item) {
            return [
                'name' => $item['company'],
                'description' => $item['company_description']
            ];
        }));
    }
}
