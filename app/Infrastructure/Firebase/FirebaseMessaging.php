<?php

namespace App\Infrastructure\Firebase;

use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class FirebaseMessaging
{
    protected $messaging;

    public function __construct()
    {
        $factory = (new Factory)
            ->withServiceAccount(config('services.fcm.credentials_path'))
            ->withProjectId(config('services.fcm.project_id'));

        $this->messaging = $factory->createMessaging();
    }

    public function sendToToken(string $token, string $title, string $body, array $data = [])
    {
        try {
            $message = CloudMessage::withTarget('token', $token)
                ->withNotification(Notification::create($title, $body))
                ->withData(array_map('strval', $data));

            $this->messaging->send($message);

            Log::info('FCM send success', ['token' => $token, 'title' => $title]);
        } catch (\Throwable $e) {
            Log::error('FCM send failed', [
                'token' => $token,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
