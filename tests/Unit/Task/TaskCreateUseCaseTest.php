<?php

namespace Tests\Unit\Task;

use App\Core\Task\DTO\TaskCreateDTO;
use App\Core\Task\Repositories\Interfaces\TaskCreateRepositoryInterface;
use App\Core\Task\UseCases\TaskCreateUseCase;
use App\Models\Task;
use PHPUnit\Framework\TestCase;

class TaskCreateUseCaseTest extends TestCase
{
    public function test_execute_returns_task_on_success()
    {
        $mockRepo = $this->createMock(TaskCreateRepositoryInterface::class);
        $dto = $this->createMock(TaskCreateDTO::class);
        $expectedTask = $this->createMock(Task::class);

        $mockRepo->expects($this->once())
            ->method('createRepo')
            ->with($dto)
            ->willReturn($expectedTask);

        $useCase = new TaskCreateUseCase($mockRepo);
        $result = $useCase->execute($dto);

        $this->assertSame($expectedTask, $result);
    }

    public function test_execute_returns_null_on_failure()
    {
        $mockRepo = $this->createMock(TaskCreateRepositoryInterface::class);
        $dto = $this->createMock(TaskCreateDTO::class);

        $mockRepo->expects($this->once())
            ->method('createRepo')
            ->with($dto)
            ->willReturn(null);

        $useCase = new TaskCreateUseCase($mockRepo);
        $result = $useCase->execute($dto);

        $this->assertNull($result);
    }
}
