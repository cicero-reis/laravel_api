<?php

namespace Tests\Unit\Core\Task;

use App\Core\Task\UseCases\Interfaces\ListTasksUseCaseInterface;
use PHPUnit\Framework\TestCase;

class ListTasksUseCaseInterfaceTest extends TestCase
{
    public function test_interface_has_execute_method()
    {
        $reflection = new \ReflectionClass(ListTasksUseCaseInterface::class);
        $this->assertTrue($reflection->hasMethod('execute'));
    }

    public function test_execute_method_signature()
    {
        $reflection = new \ReflectionMethod(ListTasksUseCaseInterface::class, 'execute');
        $parameters = $reflection->getParameters();
        $this->assertCount(2, $parameters);
        $this->assertEquals('filters', $parameters[0]->getName());
        $this->assertEquals('paginate', $parameters[1]->getName());
    }
}
