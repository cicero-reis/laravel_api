<?php

namespace App\Http\Controllers\Api\V1\Task;

use App\Core\Task\DTO\Factories\TaskUpdateIsCompletedDTOFactory;
use App\Core\Task\UseCases\Interfaces\TaskUpdateIsCompletedUseCaseInterface;
use App\Exceptions\Factory\MensagemDetailsExceptionFactory;
use App\Exceptions\NotFoundException;
use App\Http\Requests\TaskUpdateIsCompletedRequest;
use App\Http\Resources\TaskResource;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\JsonResponse;

class TaskUpdateIsCompletedController
{
    protected $useCase;

    public function __construct(TaskUpdateIsCompletedUseCaseInterface $useCase)
    {
        $this->useCase = $useCase;
    }

    public function __invoke(TaskUpdateIsCompletedRequest $request, int $id): JsonResponse
    {
        try {
            $dto = TaskUpdateIsCompletedDTOFactory::updateIsCompletedFromArray([
                'id' => $id,
                'is_completed' => $request->input('is_completed'),
            ]);

            $task = $this->useCase->execute($dto);

            if (! $task) {
                throw new NotFoundException('No tasks found', null, 404);
            }

            $result = new TaskResource($task);

            return new JsonResponse($result, 200);
        } catch (NotFoundException $e) {
            $message = MensagemDetailsExceptionFactory::create($e->getMessage(), 'error', 404);

            return new JsonResponse($message->toArray(), 404);
        } catch (AuthorizationException $e) {
            $message = MensagemDetailsExceptionFactory::create('Unauthorized', 'error', 403);

            return new JsonResponse($message->toArray(), 403);
        } catch (\Exception $e) {
            Log::channel('cloudwatch')->info('TaskPaginateController', [
                'error' => $e->getMessage(),
            ]);

            return new JsonResponse(['error' => 'An error occurred while fetching tasks'], 500);
        } catch (\Throwable $e) {
            Log::channel('cloudwatch')->info('TaskPaginateController', [
                'error' => $e->getMessage(),
            ]);

            return new JsonResponse(['error' => 'A critical error occurred'], 500);
        }
    }
}
