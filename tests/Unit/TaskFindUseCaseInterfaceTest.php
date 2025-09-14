<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Core\Task\UseCases\Interfaces\TaskFindUseCaseInterface;
use App\Models\Task;
use PHPUnit\Framework\TestCase;

class TaskFindUseCaseInterfaceTest extends TestCase
{
    public function test_execute_returns_task_when_found()
    {
        $mock = $this->createMock(TaskFindUseCaseInterface::class);
        $task = new Task;
        $mock->method('execute')->willReturn($task);

        $result = $mock->execute(1);
        $this->assertInstanceOf(Task::class, $result);
        $this->assertSame($task, $result);
    }

    public function test_execute_returns_null_when_not_found()
    {
        $mock = $this->createMock(TaskFindUseCaseInterface::class);
        $mock->method('execute')->willReturn(null);

        $result = $mock->execute(999);
        $this->assertNull($result);
    }
}
