<?php

namespace App\Exceptions\Factory;

use App\Exceptions\MensagemDetailsException;

class MensagemDetailsExceptionFactory
{
    public static function create(string $message, string $type = 'error', int $code = 400): MensagemDetailsException
    {
        return new MensagemDetailsException($message, $type, $code);
    }
}
