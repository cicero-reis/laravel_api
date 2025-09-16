<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Core\User\UseCases\Interfaces\UserDeleteUseCaseInterface;
use App\Exceptions\Factory\MensagemDetailsExceptionFactory;
use App\Exceptions\NotFoundException;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserDeleteController
{
    protected $useCase;

    public function __construct(UserDeleteUseCaseInterface $useCase)
    {
        $this->useCase = $useCase;
    }

    public function __invoke(int $id): JsonResponse
    {
        try {
            $deleted = $this->useCase->execute($id);
            if (! $deleted) {
                throw new NotFoundException('No user found', 404);
            }

            return new JsonResponse(null, 204);
        } catch (NotFoundException $e) {
            $message = MensagemDetailsExceptionFactory::create($e->getMessage(), 'error', 404);

            return new JsonResponse($message->toArray(), 404);
        } catch (\Exception $e) {
            Log::channel('cloudwatch')->info('UserDeleteController', [
                'error' => $e->getMessage(),
            ]);

            return new JsonResponse(['error' => 'An error occurred while fetching user'], 500);
        } catch (\Throwable $e) {
            Log::channel('cloudwatch')->info('UserDeleteController', [
                'error' => $e->getMessage(),
            ]);

            return new JsonResponse(['error' => 'A critical error occurred'], 500);
        }
    }
}
