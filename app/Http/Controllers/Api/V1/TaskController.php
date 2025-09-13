<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\TaskResourceCollection;
use App\Core\Task\UseCases\Interfaces\ListTasksUseCaseInterface;

class TaskController extends Controller
{
    protected ListTasksUseCaseInterface $listTasksUseCase;

    public function __construct(ListTasksUseCaseInterface $listTasksUseCase)
    {
        $this->listTasksUseCase = $listTasksUseCase;    
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        try {

            $filters = request()->only(['name','is_completed','created_at']);
    
            $tasks = $this->listTasksUseCase->execute($filters, true);
    
            if (empty($tasks->items())) {
                throw new \App\Exceptions\NotFoundException('No tasks found', 404);
            }
    
            $tasksCollection = new TaskResourceCollection($tasks);
    
            return new JsonResponse($tasksCollection, 200);
        } catch (\App\Exceptions\NotFoundException $e) {
            return new JsonResponse(['error' => $e->getMessage()], $e->getCode());
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'An error occurred while fetching tasks'], 500);
        } catch (\Throwable $e) {
            return new JsonResponse(['error' => 'A critical error occurred'], 500);
        }
    }

    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(StoreTaskRequest $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     */
    // public function show(Task $task)
    // {
    //     return new TaskResource($task);
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(Task $task)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(UpdateTaskRequest $request, Task $task)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Task $task)
    // {
    //     //
    // }
}
