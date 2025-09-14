<?php

namespace App\Http\Controllers\Api\V1;

use App\Core\Task\UseCases\Interfaces\TaskListUseCaseInterface;
use App\Http\Resources\TaskResourceCollection;
use Illuminate\Http\JsonResponse;
use App\Exceptions\NotFoundException;
use App\Exceptions\MensagemDetailsException;

class TaskListController
{
    protected $taskListUseCase;

    public function __construct(TaskListUseCaseInterface $taskListUseCase)
    {
        $this->taskListUseCase = $taskListUseCase;
    }

    public function __invoke(): JsonResponse
    {
        try {

            $filters = request()->only(['name', 'is_completed', 'created_at']);

            $tasks = $this->taskListUseCase->execute($filters, true);

            if (empty($tasks->items())) {
                throw new NotFoundException('No tasks found', 404);
            }

            $tasksCollection = new TaskResourceCollection($tasks);

            return new JsonResponse($tasksCollection, 200);
        } catch (NotFoundException $e) {
            $message = new MensagemDetailsException($e->getMessage(), 'error', 404);
            return new JsonResponse($message->toArray(), 404);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'An error occurred while fetching tasks'], 500);
        } catch (\Throwable $e) {
            return new JsonResponse(['error' => 'A critical error occurred'], 500);
        }
    }
}
