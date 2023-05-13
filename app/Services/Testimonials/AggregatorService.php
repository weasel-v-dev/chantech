<?php


namespace App\Services\Testimonials;

class AggregatorService
{
    public function saveTestimonials($data): array
    {

        $company = new CompanyService($data);
        $position = new PositionService($data);
        $employee = new EmployeeService($data);
        $reviewer = new ReviewerService($data);
        $review = new ReviewService($data);

        $services = [$company, $position, $reviewer, $employee, $review];

        foreach ($services as $service) {
            $service->createMassive();
        }

        return ['Testimonials saved'];
    }
}
