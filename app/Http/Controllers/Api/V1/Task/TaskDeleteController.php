<?php

namespace App\Http\Controllers\Api\V1\Task;

use App\Core\Task\UseCases\Interfaces\TaskDeleteUseCaseInterface;
use App\Exceptions\Factory\MensagemDetailsExceptionFactory;
use App\Exceptions\NotFoundException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Log;
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
            
        } catch (AuthorizationException $e) {
            $message = MensagemDetailsExceptionFactory::create('Unauthorized', 'error', 403);

            return new JsonResponse($message->toArray(), 403);
        } catch (NotFoundException $e) {
            $message = MensagemDetailsExceptionFactory::create($e->getMessage(), 'error', 404);

            return new JsonResponse($message->toArray(), 404);
        } catch (\Exception $e) {
            Log::channel('cloudwatch')->info('TaskDeleteController', [
                'error' => $e->getMessage(),
            ]);

            return new JsonResponse(['error' => 'An error occurred while fetching tasks'], 500);
        } catch (\Throwable $e) {
            Log::channel('cloudwatch')->info('TaskDeleteController', [
                'error' => $e->getMessage(),
            ]);

            return new JsonResponse(['error' => 'A critical error occurred'], 500);
        }
    }
}
