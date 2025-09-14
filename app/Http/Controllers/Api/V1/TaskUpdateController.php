<?php

namespace App\Http\Controllers\Api\V1;

use App\Core\Task\UseCases\Interfaces\TaskUpdateUseCaseInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Http\Requests\UpdateTaskRequest;
use App\Core\Task\DTO\TaskUpdateDTO;
use App\Http\Resources\TaskResource;
use App\Exceptions\NotFoundException;
use App\Exceptions\MensagemDetailsException;

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
            $dto = new TaskUpdateDTO(
                $id,
                $request->input('name')
            );

            $task = $this->useCase->execute($dto);

            if (!$task) {
                throw new NotFoundException('No tasks found', null, 404);
            }

            $result = new TaskResource($task);
            return new JsonResponse($result, 200);
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
