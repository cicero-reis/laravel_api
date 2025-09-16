<?php

namespace App\Http\Controllers\Api\V1\Task;

use App\Core\Task\DTO\Factories\TaskCreateDTOFactory;
use App\Core\Task\UseCases\Interfaces\TaskCreateUseCaseInterface;
use App\Exceptions\Factory\MensagemDetailsExceptionFactory;
use App\Exceptions\NotFoundException;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Resources\TaskResource;
use Symfony\Component\HttpFoundation\JsonResponse;

class TaskCreateController
{
    protected $useCase;

    public function __construct(TaskCreateUseCaseInterface $useCase)
    {
        $this->useCase = $useCase;
    }

    public function __invoke(StoreTaskRequest $request): JsonResponse
    {
        try {

            $dto = TaskCreateDTOFactory::createFromArray([
                'name' => $request->input('name'),
            ]);

            $task = $this->useCase->execute($dto);
            if (! $task) {
                throw new NotFoundException('No tasks found', null, 400);
            }
            $result = new TaskResource($task);

            return new JsonResponse($result, 201);
        } catch (NotFoundException $e) {
            $message = MensagemDetailsExceptionFactory::create($e->getMessage(), 'error', 404);

            return new JsonResponse($message->toArray(), 400);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'An error occurred while fetching tasks'], 500);
        } catch (\Throwable $e) {
            return new JsonResponse(['error' => 'A critical error occurred'], 500);
        }
    }
}
