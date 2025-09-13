<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Task Repository Bindings
        $this->app->bind(
            \App\Core\Task\Repositories\Interfaces\ListTasksRepositoryInterface::class,
            \App\Core\Task\Repositories\ListTasksRepository::class
        );

        // Task Use Case Bindings
        $this->app->bind(
            \App\Core\Task\UseCases\Interfaces\ListTasksUseCaseInterface::class,
            \App\Core\Task\UseCases\ListTasksUseCase::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {}
}
