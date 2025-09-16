<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Core\User\UseCases\Interfaces\UserListUseCaseInterface;
use App\Exceptions\Factory\MensagemDetailsExceptionFactory;
use App\Exceptions\NotFoundException;
use App\Http\Resources\UserResourceCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class UserListController
{
    private UserListUseCaseInterface $userListUseCase;

    public function __construct(UserListUseCaseInterface $userListUseCase)
    {
        $this->userListUseCase = $userListUseCase;
    }

    public function __invoke(): JsonResponse
    {
        try {

            $filters = request()->only(['name', 'email', 'created_at']);

            $users = $this->userListUseCase->execute($filters, true);

            if (empty($users->items())) {
                throw new NotFoundException('No users found', 404);
            }

            $usersCollection = new UserResourceCollection($users);

            return new JsonResponse($usersCollection, 200);
        } catch (NotFoundException $e) {
            $message = MensagemDetailsExceptionFactory::create($e->getMessage(), 'error', 404);
            return new JsonResponse($message->toArray(), 404);
        } catch (\Exception $e) {
            Log::channel('cloudwatch')->info('UserListController', [
                'error' => $e->getMessage()
            ]);
            return new JsonResponse(['error' => 'An error occurred while fetching tasks'], 500);
        } catch (\Throwable $e) {
            Log::channel('cloudwatch')->info('UserListController', [
                'error' => $e->getMessage()
            ]);
            return new JsonResponse(['error' => $e->getMessage()], 500);
        }
    }
}
