<?php

namespace App\Providers;

use App\Helpers\UniqueIdentifier;
use App\Helpers\UniqueIdentifierInterface;
use App\Repositories\TimeRecordRepository;
use App\Repositories\TimeRecordRepositoryInterface;
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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
