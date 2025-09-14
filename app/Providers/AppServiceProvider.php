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
            \App\Core\Task\Repositories\Interfaces\TaskListRepositoryInterface::class,
            \App\Core\Task\Repositories\TaskListRepository::class
        );
        $this->app->bind(
            \App\Core\Task\Repositories\Interfaces\TaskFindRepositoryInterface::class,
            \App\Core\Task\Repositories\TaskFindRepository::class
        );
        $this->app->bind(
            \App\Core\Task\Repositories\Interfaces\TaskCreateRepositoryInterface::class,
            \App\Core\Task\Repositories\TaskCreateRepository::class
        );
        $this->app->bind(
            \App\Core\Task\Repositories\Interfaces\TaskUpdateRepositoryInterface::class,
            \App\Core\Task\Repositories\TaskUpdateRepository::class
        );
        $this->app->bind(
            \App\Core\Task\Repositories\Interfaces\TaskDeleteRepositoryInterface::class,
            \App\Core\Task\Repositories\TaskDeleteRepository::class
        );
        $this->app->bind(
            \App\Core\Task\Repositories\Interfaces\TaskUpdateIsCompletedRepositoryInterface::class,
            \App\Core\Task\Repositories\TaskUpdateIsCompletedRepository::class
        );

        // Task Use Case Bindings
        $this->app->bind(
            \App\Core\Task\UseCases\Interfaces\TaskListUseCaseInterface::class,
            \App\Core\Task\UseCases\TaskListUseCase::class
        );
        $this->app->bind(
            \App\Core\Task\UseCases\Interfaces\TaskFindUseCaseInterface::class,
            \App\Core\Task\UseCases\TaskFindUseCase::class
        );
        $this->app->bind(
            \App\Core\Task\UseCases\Interfaces\TaskCreateUseCaseInterface::class,
            \App\Core\Task\UseCases\TaskCreateUseCase::class
        );
        $this->app->bind(
            \App\Core\Task\UseCases\Interfaces\TaskUpdateUseCaseInterface::class,
            \App\Core\Task\UseCases\TaskUpdateUseCase::class
        );
        $this->app->bind(
            \App\Core\Task\UseCases\Interfaces\TaskDeleteUseCaseInterface::class,
            \App\Core\Task\UseCases\TaskDeleteUseCase::class
        );
        $this->app->bind(
            \App\Core\Task\UseCases\Interfaces\TaskUpdateIsCompletedUseCaseInterface::class,
            \App\Core\Task\UseCases\TaskUpdateIsCompletedUseCase::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {}
}
