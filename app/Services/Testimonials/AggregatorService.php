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

        $columns = [$company, $position, $reviewer, $employee, $review];

        foreach ($columns as $column) {
            $column->createMassive();
        }

        return ['Testimonials saved'];
    }
}
