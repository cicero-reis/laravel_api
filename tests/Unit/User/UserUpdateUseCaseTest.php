<?php

namespace Tests\Unit\User;

use App\Core\User\UseCases\Interfaces\UserUpdateUseCaseInterface;
use PHPUnit\Framework\TestCase;

class UserUpdateUseCaseTest extends TestCase
{
    public function test_interface_has_execute_method()
    {
        $reflection = new \ReflectionClass(UserUpdateUseCaseInterface::class);
        $this->assertTrue($reflection->hasMethod('execute'));
    }
}
