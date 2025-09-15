<?php

namespace App\Http\Controllers\Api\V1;

use App\Core\Task\DTO\Factories\TaskUpdateDTOFactory;
use App\Core\Task\UseCases\Interfaces\TaskUpdateUseCaseInterface;
use App\Exceptions\Factory\MensagemDetailsExceptionFactory;
use App\Exceptions\NotFoundException;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use Symfony\Component\HttpFoundation\JsonResponse;

class TaskUpdateController
{
    protected $useCase;

    public function __construct(TaskUpdateUseCaseInterface $useCase)
    {
        $this->useCase = $useCase;
    }

    public function __invoke(UpdateTaskRequest $request, int $id): JsonResponse
    {
        try {
            $dto = TaskUpdateDTOFactory::updateFromArray([
                'id' => $id,
                'name' => $request->input('name'),
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
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], 500);
        } catch (\Throwable $e) {
            return new JsonResponse(['error' => 'A critical error occurred'], 500);
        }
    }
}
