<?php

namespace Tests\Unit\User;

use App\Core\User\UseCases\Interfaces\UserDeleteUseCaseInterface;
use PHPUnit\Framework\TestCase;

class UserDeleteUseCaseTest extends TestCase
{
    public function test_interface_has_execute_method()
    {
        $reflection = new \ReflectionClass(UserDeleteUseCaseInterface::class);
        $this->assertTrue($reflection->hasMethod('execute'));
    }
}
