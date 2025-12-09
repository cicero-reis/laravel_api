<?php

namespace App\Providers;

use App\Core\Task\Services\Delivery\DeliveryStatusService;
use App\Core\Task\Services\Delivery\DueToday;
use App\Core\Task\Services\Delivery\Overdue;
use App\Core\Task\Services\Delivery\WithinDeadline;
use App\Models\Task;
use App\Models\User;
use App\Observers\TaskObserver;
use App\Observers\UserObserver;
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
            \App\Core\Task\Repositories\Interfaces\TaskPaginatetRepositoryInterface::class,
            \App\Core\Task\Repositories\TaskPaginateRepository::class
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

        $this->app->bind(
            \App\Core\Task\Repositories\Interfaces\TaskUpdateUserIdRepositoryInterface::class,
            \App\Core\Task\Repositories\TaskUpdateUserIdRepository::class
        );

        $this->app->bind(
            \App\Core\Task\Repositories\Interfaces\TaskETLRepositoryInterface::class,
            \App\Core\Task\Repositories\TaskETLRepository::class
        );

        // Task Use Case Bindings
        $this->app->bind(
            \App\Core\Task\UseCases\Interfaces\TaskPaginateUseCaseInterface::class,
            \App\Core\Task\UseCases\TaskPaginateUseCase::class
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
        $this->app->bind(
            \App\Core\Task\UseCases\Interfaces\TaskUpdateUserIdUseCaseInterface::class,
            \App\Core\Task\UseCases\TaskUpdateUserIdUseCase::class
        );

        // User Repository Bindings
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
        $this->app->bind(
            \App\Core\User\Repositories\Interfaces\UserProfileRepositoryInterface::class,
            \App\Core\User\Repositories\UserProfileRepository::class,
        );
        $this->app->bind(
            \App\Core\User\Repositories\Interfaces\UserUpdateFCMTokenRepositoryInterface::class,
            \App\Core\User\Repositories\UserUpdateFCMTokenRepository::class
        );
        $this->app->bind(
            \App\Core\User\Repositories\Interfaces\UserTaskSummaryRepositoryInterface::class,
            \App\Core\User\Repositories\UserTaskSummaryRepository::class
        );

        // User Use Case Bindings
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
        $this->app->bind(
            \App\Core\User\UseCases\Interfaces\UserProfileUserCaseInterface::class,
            \App\Core\User\UseCases\UserProfileUserCase::class
        );
        $this->app->bind(
            \App\Core\User\UseCases\Interfaces\UserUpdateFCMTokenUseCaseInterface::class,
            \App\Core\User\UseCases\UserUpdateFCMTokenUseCase::class
        );
        $this->app->bind(
            \App\Core\User\UseCases\Interfaces\UserTaskSummaryUseCaseInterface::class,
            \App\Core\User\UseCases\UserTaskSummaryUseCase::class
        );

        // JWT Auth Service Binding
        $this->app->bind(
            \App\Infrastructure\JWT\Interfaces\LoginServiceInterface::class,
            \App\Infrastructure\JWT\Services\LoginService::class
        );
        $this->app->bind(
            \App\Infrastructure\JWT\Interfaces\LogoutServiceInterface::class,
            \App\Infrastructure\JWT\Services\LogoutService::class
        );
        $this->app->bind(
            \App\Infrastructure\JWT\Interfaces\RefreshServiceInterface::class,
            \App\Infrastructure\JWT\Services\RefreshService::class
        );

        $this->app->bind(
            \App\Infrastructure\AWS\S3\S3RepositoryInterface::class,
            \App\Infrastructure\AWS\S3\S3Repository::class
        );

        $this->app->bind(
            \App\Core\Task\UseCases\Interfaces\TaskETLUseCaseInterface::class,
            \App\Core\Task\UseCases\TaskETLUseCase::class
        );

        // Strategies
        $this->app->singleton(WithinDeadline::class);
        $this->app->singleton(DueToday::class);
        $this->app->singleton(Overdue::class);

        $this->app->singleton(DeliveryStatusService::class, function ($app) {
            return new DeliveryStatusService([
                $app->make(WithinDeadline::class),
                $app->make(DueToday::class),
                $app->make(Overdue::class),
            ]);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);
        Task::observe(TaskObserver::class);
    }
}
