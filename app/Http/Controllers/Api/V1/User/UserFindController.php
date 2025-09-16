<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Core\User\UseCases\Interfaces\UserFindUseCaseInterface;
use App\Exceptions\Factory\MensagemDetailsExceptionFactory;
use App\Exceptions\NotFoundException;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class UserFindController
{
    protected $useCase;

    public function __construct(UserFindUseCaseInterface $useCase)
    {
        $this->useCase = $useCase;
    }

    public function __invoke(int $id): JsonResponse
    {
        try {

            $task = $this->useCase->execute($id);

            if (empty($task)) {
                throw new \App\Exceptions\NotFoundException('No user found', 404);
            }

            $result = new UserResource($task);

            return new JsonResponse($result, 200);

        } catch (NotFoundException $e) {
            $message = MensagemDetailsExceptionFactory::create($e->getMessage(), 'error', 404);
            return new JsonResponse($message->toArray(), 404);
        } catch (\Exception $e) {
            Log::channel('cloudwatch')->info('UserFindController', [
                'error' => $e->getMessage()
            ]);
            return new JsonResponse(['error' => 'An error occurred while fetching user'], 500);
        } catch (\Throwable $e) {
            Log::channel('cloudwatch')->info('UserFindController', [
                'error' => $e->getMessage()
            ]);
            return new JsonResponse(['error' => 'A critical error occurred'], 500);
        }
    }
}
