<?php

// API Routes

// User Controllers
use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Auth\LogoutController;
use App\Http\Controllers\Api\V1\Auth\RefreshController;
use App\Http\Controllers\Api\V1\ETL\ETLController;
use App\Http\Controllers\Api\V1\Task\TaskCreateController;
use App\Http\Controllers\Api\V1\Task\TaskDeleteController;
use App\Http\Controllers\Api\V1\Task\TaskFindController;
use App\Http\Controllers\Api\V1\Task\TaskPaginateController;
// Task Controllers
use App\Http\Controllers\Api\V1\Task\TaskUpdateController;
use App\Http\Controllers\Api\V1\Task\TaskUpdateIsCompletedController;
use App\Http\Controllers\Api\V1\Task\TaskUpdateUserIdController;
use App\Http\Controllers\Api\V1\User\UserCreateController;
use App\Http\Controllers\Api\V1\User\UserDeleteController;
use App\Http\Controllers\Api\V1\User\UserFindController;
use App\Http\Controllers\Api\V1\User\UserListController;
use App\Http\Controllers\Api\V1\User\UserProfileController;
use App\Http\Controllers\Api\V1\User\UserTaskSummaryController;
use App\Http\Controllers\Api\V1\User\UserUpdateController;
use App\Http\Controllers\Api\V1\User\UserUpdateFCMTokenController;
use Illuminate\Http\Request;
// ETL
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {

    Route::post('/auth/login', LoginController::class)->name('api.v1.auth.login');
    Route::post('/auth/refresh', RefreshController::class)->name('api.v1.auth.refresh');
    Route::post('/auth/logout', LogoutController::class)->name('api.v1.auth.logout');
    Route::post('/auth/create', UserCreateController::class);

    Route::middleware(['auth:api', 'role:dev,admin,user'])->group(function () {

        Route::prefix('users')->group(function () {
            Route::get('/', UserListController::class);
            Route::get('/{id}', UserFindController::class);
            Route::post('/', UserCreateController::class);
            Route::put('/{id}', UserUpdateController::class);
            Route::delete('/{id}', UserDeleteController::class);
            Route::post('/upload-profile/{id}', [UserProfileController::class, 'upload']);
            Route::post('/fcm-token/{id}', UserUpdateFCMTokenController::class);
            Route::get('/{id}/tasksummary', UserTaskSummaryController::class);
        });

        Route::prefix('tasks')->group(function () {
            Route::get('/', TaskPaginateController::class);
            Route::get('/{id}', TaskFindController::class);
            Route::post('/', TaskCreateController::class);
            Route::put('/{id}', TaskUpdateController::class);
            Route::delete('/{id}', TaskDeleteController::class);
            Route::patch('/iscompleted/{id}', TaskUpdateIsCompletedController::class);
            Route::patch('/userid/{id}', TaskUpdateUserIdController::class);
        });

        Route::prefix('etl')->group(function () {
            Route::get('/transform-tasks', [ETLController::class, 'transformTasks']);
            // Route::get('/dashboard', [ETLController::class, 'dashboard']);
        });
    });
});
