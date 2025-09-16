<?php

namespace Tests\Unit\User;

use App\Core\User\UseCases\Interfaces\UserCreateUseCaseInterface;
use PHPUnit\Framework\TestCase;

class UserCreateUseCaseTest extends TestCase
{
    public function test_interface_has_execute_method()
    {
        $reflection = new \ReflectionClass(UserCreateUseCaseInterface::class);
        $this->assertTrue($reflection->hasMethod('execute'));
    }
}
