<?php

declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Core\Task\UseCases\Interfaces\TaskUpdateIsCompletedUseCaseInterface;
use App\Core\Task\DTO\TaskUpdateIsCompletedDTO;
use App\Models\Task;

class TaskUpdateIsCompletedUseCaseInterfaceTest extends TestCase
{
    public function test_execute_returns_task_or_null()
    {
        $mockUseCase = $this->createMock(TaskUpdateIsCompletedUseCaseInterface::class);
        $dto = $this->createMock(TaskUpdateIsCompletedDTO::class);
        $task = $this->createMock(Task::class);

        $mockUseCase->method('execute')
            ->willReturnOnConsecutiveCalls($task, null);

        $this->assertInstanceOf(Task::class, $mockUseCase->execute($dto));
        $this->assertNull($mockUseCase->execute($dto));
    }
}
