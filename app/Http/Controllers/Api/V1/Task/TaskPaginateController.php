<?php

namespace App\Http\Controllers\Api\V1\Task;

use App\Core\Task\UseCases\Interfaces\TaskPaginateUseCaseInterface;
use App\Exceptions\Factory\MensagemDetailsExceptionFactory;
use App\Exceptions\NotFoundException;
use App\Http\Resources\TaskResourceCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class TaskPaginateController
{
    protected $TaskPaginateUseCase;

    public function __construct(TaskPaginateUseCaseInterface $TaskPaginateUseCase)
    {
        $this->TaskPaginateUseCase = $TaskPaginateUseCase;
    }

    public function __invoke(): JsonResponse
    {
        try {

            $filters = request()->only(['name', 'is_completed', 'created_at']);

            $tasks = $this->TaskPaginateUseCase->execute($filters, 5);

            if ($tasks->count() == 0) {
                throw new NotFoundException('No tasks found', 404);
            }

            $tasksCollection = new TaskResourceCollection($tasks);

            return new JsonResponse($tasksCollection, 200);
        } catch (NotFoundException $e) {
            $message = MensagemDetailsExceptionFactory::create($e->getMessage(), 'error', 404);

            return new JsonResponse($message->toArray(), 404);
        } catch (\Exception $e) {
            Log::channel('cloudwatch')->info('TaskPaginateController', [
                'error' => $e->getMessage(),
            ]);

            return new JsonResponse(['error' => $e->getMessage()], 500);
        } catch (\Throwable $e) {
            Log::channel('cloudwatch')->info('TaskPaginateController', [
                'error' => $e->getMessage(),
            ]);

            return new JsonResponse(['error' => $e->getMessage()], 500);
        }
    }
}
