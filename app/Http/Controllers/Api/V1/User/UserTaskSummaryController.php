<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Core\User\UseCases\Interfaces\UserTaskSummaryUseCaseInterface;
use App\Exceptions\Factory\MensagemDetailsExceptionFactory;
use App\Exceptions\NotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class UserTaskSummaryController
{
    protected $useCase;

    public function __construct(UserTaskSummaryUseCaseInterface $useCase)
    {
        $this->useCase = $useCase;
    }

    public function __invoke(int $id): JsonResponse
    {
        try {

            $user = $this->useCase->execute($id);

            if ($user->count() == 0) {
                throw new \App\Exceptions\NotFoundException('No user found', 404);
            }

            return new JsonResponse($user[0], 200);

        } catch (NotFoundException $e) {
            $message = MensagemDetailsExceptionFactory::create($e->getMessage(), 'error', 404);

            return new JsonResponse($message->toArray(), 404);
        } catch (\Exception $e) {
            Log::channel('cloudwatch')->info('UserFindController', [
                'error' => $e->getMessage(),
            ]);

            return new JsonResponse(['error' => 'An error occurred while fetching user'], 500);
        } catch (\Throwable $e) {
            Log::channel('cloudwatch')->info('UserFindController', [
                'error' => $e->getMessage(),
            ]);

            return new JsonResponse(['error' => 'A critical error occurred'], 500);
        }
    }
}
