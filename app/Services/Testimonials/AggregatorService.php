<?php


namespace App\Services\Testimonials;

class AggregatorService
{
    protected function createServices($data = []): array
    {
        $company = new CompanyService($data);
        $position = new PositionService($data);
        $employee = new EmployeeService($data);
        $reviewer = new ReviewerService($data);
        $review = new ReviewService($data);

        return [$company, $position, $reviewer, $employee, $review];
    }

    public function saveTestimonials($data): array
    {
        $services = $this->createServices($data);
        foreach ($services as $service) {
            $service->createMassive();
        }

        return [
            [
                'id' => 1,
                'message' => 'Testimonials saved',
                'status' => 'success'
            ]
        ];
    }

    public function removeTestimonials(): array
    {
        $services = $this->createServices();
        foreach ($services as $service) {
            $service->removeMassive();
        }

        return [
            [
                'id' => 1,
                'message' => 'Testimonials removed',
                'status' => 'success'
            ]
        ];
    }
}
