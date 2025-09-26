<?php

// API Routes

// User Controllers
use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Auth\LogoutController;
use App\Http\Controllers\Api\V1\Auth\RefreshController;
use App\Http\Controllers\Api\V1\Task\TaskCreateController;
use App\Http\Controllers\Api\V1\Task\TaskDeleteController;
use App\Http\Controllers\Api\V1\Task\TaskFindController;
use App\Http\Controllers\Api\V1\Task\TaskPaginateController;
use App\Http\Controllers\Api\V1\Task\TaskUpdateController;
// Task Controllers
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
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {

    Route::post('/auth/login', LoginController::class)->name('api.v1.auth.login');
    Route::post('/auth/refresh', RefreshController::class)->name('api.v1.auth.refresh');
    Route::post('/auth/logout', LogoutController::class)->name('api.v1.auth.logout');

    Route::middleware(['auth:api', 'role:dev,admin,user'])->group(function () {

        // User routes
        Route::get('/users', UserListController::class);
        Route::get('/users/{id}', UserFindController::class);
        Route::post('/users', UserCreateController::class);
        Route::put('/users/{id}', UserUpdateController::class);
        Route::delete('/users/{id}', UserDeleteController::class);
        Route::post('/users/upload-profile/{id}', [UserProfileController::class, 'upload']);
        Route::post('/users/fcm-token/{id}', UserUpdateFCMTokenController::class);
        Route::get('/users/tasksummary/{id}', UserTaskSummaryController::class);

        // Task routes
        Route::get('/tasks', TaskPaginateController::class);
        Route::get('/tasks/{id}', TaskFindController::class);
        Route::post('/tasks', TaskCreateController::class);
        Route::put('/tasks/{id}', TaskUpdateController::class);
        Route::delete('/tasks/{id}', TaskDeleteController::class);
        Route::patch('/tasks/iscompleted/{id}', TaskUpdateIsCompletedController::class);
        Route::patch('/tasks/userid/{id}', TaskUpdateUserIdController::class);
    });

});
