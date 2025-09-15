<?php

namespace App\Http\Controllers\Api\V1;

use App\Core\Task\UseCases\Interfaces\TaskDeleteUseCaseInterface;
use App\Exceptions\Factory\MensagemDetailsExceptionFactory;
use App\Exceptions\NotFoundException;
use Symfony\Component\HttpFoundation\JsonResponse;

class TaskDeleteController
{
    protected $useCase;

    public function __construct(TaskDeleteUseCaseInterface $useCase)
    {
        $this->useCase = $useCase;
    }

    public function __invoke(int $id): JsonResponse
    {
        try {
            $deleted = $this->useCase->execute($id);
            if (! $deleted) {
                throw new NotFoundException('No tasks found', 404);
            }

            return new JsonResponse(null, 204);
        } catch (NotFoundException $e) {
            $message = MensagemDetailsExceptionFactory::create($e->getMessage(), 'error', 404);

            return new JsonResponse($message->toArray(), 404);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'An error occurred while fetching tasks'], 500);
        } catch (\Throwable $e) {
            return new JsonResponse(['error' => 'A critical error occurred'], 500);
        }
    }
}
