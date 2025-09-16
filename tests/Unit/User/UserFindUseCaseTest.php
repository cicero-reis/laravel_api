<?php

namespace Tests\Unit\User;

use App\Core\User\UseCases\Interfaces\UserFindUseCaseInterface;
use PHPUnit\Framework\TestCase;

class UserFindUseCaseTest extends TestCase
{
    public function test_interface_has_execute_method()
    {
        $reflection = new \ReflectionClass(UserFindUseCaseInterface::class);
        $this->assertTrue($reflection->hasMethod('execute'));
    }
}
