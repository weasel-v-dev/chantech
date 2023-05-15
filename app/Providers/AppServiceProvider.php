<?php

namespace App\Providers;


use App\Models\Company;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Reviewer;
use App\Observers\CompanyObserver;
use App\Observers\EmployeeObserver;
use App\Observers\PositionObserver;
use App\Observers\ReviewerObserver;
use App\Services\Testimonials\AggregatorService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AggregatorService::class, function () {
            return new AggregatorService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Company::observe(CompanyObserver::class);
        Employee::observe(EmployeeObserver::class);
        Position::observe(PositionObserver::class);
        Reviewer::observe(ReviewerObserver::class);
    }
}
