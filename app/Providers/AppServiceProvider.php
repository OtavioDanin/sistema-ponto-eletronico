<?php

namespace App\Providers;

use App\Helpers\AuthUser;
use App\Helpers\AuthUserInterface;
use App\Helpers\UniqueIdentifier;
use App\Helpers\UniqueIdentifierInterface;
use App\Repositories\EmployeeRepository;
use App\Repositories\EmployeeRepositoryInterface;
use App\Repositories\TimeRecordRepository;
use App\Repositories\TimeRecordRepositoryInterface;
use App\Repositories\TypeEmployeeRepository;
use App\Repositories\TypeEmployeeRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use App\Services\EmployeeService;
use App\Services\EmployeeServiceInterface;
use App\Services\TimeRecordService;
use App\Services\TimeRecordServiceInterface;
use App\Services\TypeEmployeeService;
use App\Services\TypeEmployeeServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthUserInterface::class, AuthUser::class);
        $this->app->bind(UniqueIdentifierInterface::class, UniqueIdentifier::class);

        $this->app->bind(TimeRecordRepositoryInterface::class, TimeRecordRepository::class);
        $this->app->bind(TimeRecordServiceInterface::class, TimeRecordService::class);

        $this->app->bind(EmployeeServiceInterface::class, EmployeeService::class);
        $this->app->bind(EmployeeRepositoryInterface::class, EmployeeRepository::class);

        $this->app->bind(TypeEmployeeRepositoryInterface::class, TypeEmployeeRepository::class);
        $this->app->bind(TypeEmployeeServiceInterface::class, TypeEmployeeService::class);

        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
