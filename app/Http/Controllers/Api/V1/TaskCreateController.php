<?php

namespace App\Http\Controllers\Api\V1;

use App\Core\Task\UseCases\Interfaces\TaskCreateUseCaseInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Http\Requests\StoreTaskRequest;
use App\Core\Task\DTO\TaskCreateDTO;
use App\Http\Resources\TaskResource;
use App\Exceptions\NotFoundException;
use App\Exceptions\MensagemDetailsException;

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
            $dto = new TaskCreateDTO(
                $request->input('name')
            );
            $task = $this->useCase->execute($dto);
            if (!$task) {
                throw new NotFoundException('No tasks found', null, 400);
            }
            $result = new TaskResource($task);
            return new JsonResponse($result, 201);
        } catch (NotFoundException $e) {
            $message = new MensagemDetailsException($e->getMessage(), 'error', 400);
            return new JsonResponse($message->toArray(), 400);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'An error occurred while fetching tasks'], 500);
        } catch (\Throwable $e) {
            return new JsonResponse(['error' => 'A critical error occurred'], 500);
        }
    }
}
