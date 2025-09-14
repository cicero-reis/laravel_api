<?php

use App\Http\Controllers\Api\V1\TaskCreateController;
use App\Http\Controllers\Api\V1\TaskDeleteController;
use App\Http\Controllers\Api\V1\TaskFindController;
use App\Http\Controllers\Api\V1\TaskListController;
use App\Http\Controllers\Api\V1\TaskUpdateController;
use App\Http\Controllers\Api\V1\TaskUpdateIsCompletedController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::get('/tasks', TaskListController::class);
    Route::get('/tasks/{id}', TaskFindController::class);
    Route::post('/tasks', TaskCreateController::class);
    Route::put('/tasks/{id}', TaskUpdateController::class);
    Route::delete('/tasks/{id}', TaskDeleteController::class);
    Route::patch('/tasks/{id}', TaskUpdateIsCompletedController::class);
});
