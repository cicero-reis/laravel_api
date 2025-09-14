<?php

namespace Tests\Unit\Core\Task\UseCases;

use PHPUnit\Framework\TestCase;
use App\Core\Task\UseCases\TaskCreateUseCase;
use App\Core\Task\Repositories\Interfaces\TaskCreateRepositoryInterface;
use App\Core\Task\DTO\TaskCreateDTO;
use App\Models\Task;

class TaskCreateUseCaseTest extends TestCase
{
    public function testExecuteReturnsTaskOnSuccess()
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

    public function testExecuteReturnsNullOnFailure()
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
