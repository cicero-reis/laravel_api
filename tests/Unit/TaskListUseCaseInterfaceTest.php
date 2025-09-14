<?php

namespace Tests\Unit;

use App\Core\Task\UseCases\Interfaces\TaskListUseCaseInterface;
use PHPUnit\Framework\TestCase;

class TaskListUseCaseInterfaceTest extends TestCase
{
    public function test_interface_has_execute_method()
    {
        $reflection = new \ReflectionClass(TaskListUseCaseInterface::class);
        $this->assertTrue($reflection->hasMethod('execute'));
    }

    public function test_execute_method_signature()
    {
        $reflection = new \ReflectionMethod(TaskListUseCaseInterface::class, 'execute');
        $parameters = $reflection->getParameters();
        $this->assertCount(2, $parameters);
        $this->assertEquals('filters', $parameters[0]->getName());
        $this->assertEquals('paginate', $parameters[1]->getName());
    }
}
