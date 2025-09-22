<?php

// API Routes

// User Controllers

use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Auth\LogoutController;
use App\Http\Controllers\Api\V1\Auth\RefreshController;
use App\Http\Controllers\Api\V1\Task\TaskCreateController;
use App\Http\Controllers\Api\V1\Task\TaskDeleteController;
use App\Http\Controllers\Api\V1\Task\TaskFindController;
use App\Http\Controllers\Api\V1\Task\TaskListController;
use App\Http\Controllers\Api\V1\Task\TaskUpdateController;
// Task Controllers
use App\Http\Controllers\Api\V1\Task\TaskUpdateIsCompletedController;
use App\Http\Controllers\Api\V1\Task\TaskUpdateUserIdController;
use App\Http\Controllers\Api\V1\User\UserCreateController;
use App\Http\Controllers\Api\V1\User\UserDeleteController;
use App\Http\Controllers\Api\V1\User\UserFindController;
use App\Http\Controllers\Api\V1\User\UserListController;
use App\Http\Controllers\Api\V1\User\UserUpdateController;
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

        // Task routes
        Route::get('/tasks', TaskListController::class);
        Route::get('/tasks/{id}', TaskFindController::class);
        Route::post('/tasks', TaskCreateController::class);
        Route::put('/tasks/{id}', TaskUpdateController::class);
        Route::delete('/tasks/{id}', TaskDeleteController::class);
        Route::patch('/tasks/iscompleted/{id}', TaskUpdateIsCompletedController::class);
        Route::patch('/tasks/userid/{id}', TaskUpdateUserIdController::class);

        // Firebase
        Route::post('/auth/fcm-token', function (Request $request) {
            $request->user()->update([
                'fcm_token' => $request->fcm_token,
            ]);
            return response()->json(['success' => true]);
        });
    });

});
