<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Core\User\DTO\Factories\UserUpdateDTOFactory;
use App\Core\User\UseCases\Interfaces\UserUpdateUseCaseInterface;
use App\Exceptions\Factory\MensagemDetailsExceptionFactory;
use App\Exceptions\NotFoundException;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Support\Facades\Log;

class UserUpdateController
{
    protected $useCase;

    public function __construct(UserUpdateUseCaseInterface $useCase)
    {
        $this->useCase = $useCase;
    }

    public function __invoke(UpdateUserRequest $request, int $id): JsonResponse
    {
        try {
            $dto = UserUpdateDTOFactory::updateFromArray([
                'id' => $id,
                'name' => $request->input('name'),
                'email' => $request->input('email'),
            ]);

            $user = $this->useCase->execute($dto, $id);

            if (! $user) {
                throw new NotFoundException('No user found', null, 404);
            }

            $result = new UserResource($user);

            return new JsonResponse($result, 200);
        } catch (NotFoundException $e) {
            $message = MensagemDetailsExceptionFactory::create($e->getMessage(), 'error', 404);

            return new JsonResponse($message->toArray(), 404);
        } catch (\Exception $e) {
            Log::channel('cloudwatch')->info('UserUpdateController', [
                'error' => $e->getMessage()
            ]);
            return new JsonResponse(['error' => $e->getMessage()], 500);
        } catch (\Throwable $e) {
            Log::channel('cloudwatch')->info('UserUpdateController', [
                'error' => $e->getMessage()
            ]);
            return new JsonResponse(['error' => 'A critical error occurred'], 500);
        }
    }
}
