<?php

namespace Tests\Unit\User;

use App\Core\User\UseCases\Interfaces\UserListUseCaseInterface;
use PHPUnit\Framework\TestCase;

class UserListUseCaseTest extends TestCase
{
    public function test_interface_has_execute_method()
    {
        $reflection = new \ReflectionClass(UserListUseCaseInterface::class);
        $this->assertTrue($reflection->hasMethod('execute'));
    }
}
