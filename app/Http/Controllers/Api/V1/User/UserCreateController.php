<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Core\User\DTO\Factories\UserCreateDTOFactory;
use App\Core\User\UseCases\Interfaces\UserCreateUseCaseInterface;
use App\Exceptions\Factory\MensagemDetailsExceptionFactory;
use App\Exceptions\NotFoundException;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Support\Facades\Log;

class UserCreateController
{
    protected $useCase;

    public function __construct(UserCreateUseCaseInterface $useCase)
    {
        $this->useCase = $useCase;
    }

    public function __invoke(StoreUserRequest $request): JsonResponse
    {
        try {

            $dto = UserCreateDTOFactory::createFromArray([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
            ]);

            $task = $this->useCase->execute($dto);
            if (! $task) {
                throw new NotFoundException('No user found', null, 400);
            }
            $result = new UserResource($task);

            return new JsonResponse($result, 201);
        } catch (NotFoundException $e) {
            $message = MensagemDetailsExceptionFactory::create($e->getMessage(), 'error', 404);
            return new JsonResponse($message->toArray(), 400);
        } catch (\Exception $e) {
            Log::channel('cloudwatch')->info('UserCreateController', [
                'error' => $e->getMessage()
            ]);
            return new JsonResponse(['error' => 'An error occurred while fetching user'], 500);
        } catch (\Throwable $e) {
            Log::channel('cloudwatch')->info('UserCreateController', [
                'error' => $e->getMessage()
            ]);
            return new JsonResponse(['error' => 'A critical error occurred'], 500);
        }
    }
}
