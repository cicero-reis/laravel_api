<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Core\Task\Repositories\Interfaces\TaskFindRepositoryInterface;
use App\Core\Task\UseCases\TaskFindUseCase;
use App\Models\Task;
use PHPUnit\Framework\TestCase;

class TaskFindUseCaseTest extends TestCase
{
    public function test_execute_returns_task_when_found()
    {
        $repo = $this->createMock(TaskFindRepositoryInterface::class);
        $task = new Task;
        $repo->method('findRepo')->willReturn($task);

        $useCase = new TaskFindUseCase($repo);
        $result = $useCase->execute(1);

        $this->assertInstanceOf(Task::class, $result);
        $this->assertSame($task, $result);
    }

    public function test_execute_returns_null_when_not_found()
    {
        $repo = $this->createMock(TaskFindRepositoryInterface::class);
        $repo->method('findRepo')->willReturn(null);

        $useCase = new TaskFindUseCase($repo);
        $result = $useCase->execute(999);

        $this->assertNull($result);
    }
}
