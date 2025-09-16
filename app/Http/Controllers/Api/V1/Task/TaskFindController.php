<?php

namespace App\Http\Controllers\Api\V1\Task;

use App\Core\Task\UseCases\Interfaces\TaskFindUseCaseInterface;
use App\Exceptions\Factory\MensagemDetailsExceptionFactory;
use App\Exceptions\NotFoundException;
use App\Http\Resources\TaskResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class TaskFindController
{
    protected $useCase;

    public function __construct(TaskFindUseCaseInterface $useCase)
    {
        $this->useCase = $useCase;
    }

    public function __invoke(int $id): JsonResponse
    {
        try {

            $task = $this->useCase->execute($id);

            if (empty($task)) {
                throw new \App\Exceptions\NotFoundException('No tasks found', 404);
            }

            $result = new TaskResource($task);

            return new JsonResponse($result, 200);

        } catch (NotFoundException $e) {
            $message = MensagemDetailsExceptionFactory::create($e->getMessage(), 'error', 404);
            return new JsonResponse($message->toArray(), 404);
        } catch (\Exception $e) {
            Log::channel('cloudwatch')->info('TaskFindController', [
                'error' => $e->getMessage()
            ]);
            return new JsonResponse(['error' => 'An error occurred while fetching tasks'], 500);
        } catch (\Throwable $e) {
            Log::channel('cloudwatch')->info('TaskFindController', [
                'error' => $e->getMessage()
            ]);
            return new JsonResponse(['error' => 'A critical error occurred'], 500);
        }
    }
}
