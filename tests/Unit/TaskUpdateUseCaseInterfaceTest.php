<?php

namespace Tests\Unit\Core\Task\UseCases\Interfaces;

use App\Core\Task\DTO\TaskUpdateDTO;
use App\Core\Task\UseCases\Interfaces\TaskUpdateUseCaseInterface;
use PHPUnit\Framework\TestCase;

class TaskUpdateUseCaseInterfaceTest extends TestCase
{
    public function test_interface_has_execute_method()
    {
        $reflection = new \ReflectionClass(TaskUpdateUseCaseInterface::class);
        $this->assertTrue($reflection->hasMethod('execute'));
    }

    public function test_execute_method_signature()
    {
        $reflection = new \ReflectionMethod(TaskUpdateUseCaseInterface::class, 'execute');
        $parameters = $reflection->getParameters();
        $this->assertCount(1, $parameters);
        $this->assertEquals('dto', $parameters[0]->getName());
        $this->assertEquals(TaskUpdateDTO::class, $parameters[0]->getType()->getName());
    }
}
