<?php

namespace App\Infrastructure\Enums;

class JWTAuthEnum
{
    public const HTTP_UNAUTHORIZED = 401;

    public const HTTP_OK = 200;

    public const HTTP_SERVER_ERROR = 500;

    public const TOKEN_INVALID_MSG = 'Token is Invalid';

    public const ERROR_TOKEN_BLACKLISTED = 'Token is Blacklisted';

    public const ERROR_TOKEN_EXPIRED = 'Token is Expired';

    public const ERROR_TOKEN_INVALID = 'Token is Invalid';

    public const ERROR_TOKEN_PROCESSING = 'An error occurred while processing the token.';

    public static function getErrorMessages(): array
    {
        return [
            'HTTP_UNAUTHORIZED' => self::HTTP_UNAUTHORIZED,
            'HTTP_OK' => self::HTTP_OK,
            'HTTP_SERVER_ERROR' => self::HTTP_SERVER_ERROR,
            'TOKEN_INVALID_MSG' => self::TOKEN_INVALID_MSG,
            'ERROR_TOKEN_BLACKLISTED' => self::ERROR_TOKEN_BLACKLISTED,
            'ERROR_TOKEN_EXPIRED' => self::ERROR_TOKEN_EXPIRED,
            'ERROR_TOKEN_INVALID' => self::ERROR_TOKEN_INVALID,
            'ERROR_TOKEN_PROCESSING' => self::ERROR_TOKEN_PROCESSING,
        ];
    }
}
