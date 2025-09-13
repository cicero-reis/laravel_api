<?php

namespace App\Exceptions;

class MensagemDetailsException
{
    private int $code;

    private string $details;

    private string $message;

    public function __construct(string $message, string $details = '', int $code = 400)
    {
        $this->message = $message;
        $this->details = $details;
        $this->code = $code;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getDetails(): string
    {
        return $this->details;
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function toArray(): array
    {
        return [
            'message' => $this->message,
            'details' => $this->details,
            'code' => $this->code,
        ];
    }
}
