<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Core\User\DTO\Factories\UserUpdateFCMDTOFactory;
use App\Core\User\UseCases\Interfaces\UserUpdateFCMTokenUseCaseInterface;
use App\Exceptions\Factory\MensagemDetailsExceptionFactory;
use App\Exceptions\NotFoundException;
use App\Http\Requests\UpdateUserFCMTokenRequest;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserUpdateFCMTokenController
{
    protected $useCase;

    public function __construct(UserUpdateFCMTokenUseCaseInterface $useCase)
    {
        $this->useCase = $useCase;
    }

    public function __invoke(UpdateUserFCMTokenRequest $request, int $id): JsonResponse
    {
        try {

            $dto = UserUpdateFCMDTOFactory::updateFromArray([
                'id' => $id,
                'fcm_token' => $request->input('fcm_token'),
            ]);

            $user = $this->useCase->execute($dto, $id);

            if (! $user) {
                throw new NotFoundException('No user found', null, 404);
            }

            return new JsonResponse(['message' => 'Success fcm token'], 200);
        } catch (NotFoundException $e) {
            $message = MensagemDetailsExceptionFactory::create($e->getMessage(), 'error', 404);

            return new JsonResponse($message->toArray(), 404);
        } catch (\Exception $e) {
            Log::channel('cloudwatch')->info('UserUpdateController', [
                'error' => $e->getMessage(),
            ]);

            return new JsonResponse(['error' => $e->getMessage()], 500);
        } catch (\Throwable $e) {
            Log::channel('cloudwatch')->info('UserUpdateController', [
                'error' => $e->getMessage(),
            ]);

            return new JsonResponse(['error' => 'A critical error occurred'], 500);
        }
    }
}
