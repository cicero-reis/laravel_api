<?php

namespace App\Providers;

use App\Models\Task;
use App\Observers\TaskObserver;
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

        # User Repository Bindings
        $this->app->bind(
            \App\Core\User\Repositories\Interfaces\UserCreateRepositoryInterface::class,
            \App\Core\User\Repositories\UserCreateRepository::class
        );
        $this->app->bind(
            \App\Core\User\Repositories\Interfaces\UserFindRepositoryInterface::class,
            \App\Core\User\Repositories\UserFindRepository::class
        );
        $this->app->bind(
            \App\Core\User\Repositories\Interfaces\UserListRepositoryInterface::class,
            \App\Core\User\Repositories\UserListRepository::class
        );
        $this->app->bind(
            \App\Core\User\Repositories\Interfaces\UserUpdateRepositoryInterface::class,
            \App\Core\User\Repositories\UserUpdateRepository::class
        );
        $this->app->bind(
            \App\Core\User\Repositories\Interfaces\UserDeleteRepositoryInterface::class,
            \App\Core\User\Repositories\UserDeleteRepository::class
        );

        # User Use Case Bindings
        $this->app->bind(
            \App\Core\User\UseCases\Interfaces\UserCreateUseCaseInterface::class,
            \App\Core\User\UseCases\UserCreateUseCase::class
        );
        $this->app->bind(
            \App\Core\User\UseCases\Interfaces\UserFindUseCaseInterface::class,
            \App\Core\User\UseCases\UserFindUseCase::class
        );
        $this->app->bind(
            \App\Core\User\UseCases\Interfaces\UserListUseCaseInterface::class,
            \App\Core\User\UseCases\UserListUseCase::class
        );
        $this->app->bind(
            \App\Core\User\UseCases\Interfaces\UserUpdateUseCaseInterface::class,
            \App\Core\User\UseCases\UserUpdateUseCase::class
        );
        $this->app->bind(
            \App\Core\User\UseCases\Interfaces\UserDeleteUseCaseInterface::class,
            \App\Core\User\UseCases\UserDeleteUseCase::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Task::observe(TaskObserver::class);
    }
}
