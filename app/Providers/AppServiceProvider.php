<?php

namespace App\Providers;

use App\Helpers\UniqueIdentifier;
use App\Helpers\UniqueIdentifierInterface;
use App\Repositories\EmployeeRepository;
use App\Repositories\EmployeeRepositoryInterface;
use App\Repositories\TimeRecordRepository;
use App\Repositories\TimeRecordRepositoryInterface;
use App\Services\EmployeeService;
use App\Services\EmployeeServiceInterface;
use App\Services\TimeRecordService;
use App\Services\TimeRecordServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TimeRecordRepositoryInterface::class, TimeRecordRepository::class);
        $this->app->bind(TimeRecordServiceInterface::class, TimeRecordService::class);
        $this->app->bind(UniqueIdentifierInterface::class, UniqueIdentifier::class);

        $this->app->bind(EmployeeServiceInterface::class, EmployeeService::class);
        $this->app->bind(EmployeeRepositoryInterface::class, EmployeeRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
