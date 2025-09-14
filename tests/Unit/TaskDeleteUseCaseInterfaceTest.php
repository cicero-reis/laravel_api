<?php

namespace Tests\Unit;

use App\Core\Task\Repositories\Interfaces\TaskDeleteRepositoryInterface;
use App\Core\Task\UseCases\TaskDeleteUseCase;
use PHPUnit\Framework\TestCase;

class TaskDeleteUseCaseInterfaceTest extends TestCase
{
    public function test_execute_returns_true_when_repository_deletes_task()
    {
        $repo = $this->createMock(TaskDeleteRepositoryInterface::class);
        $repo->method('deleteRepo')->willReturn(true);

        $useCase = new TaskDeleteUseCase($repo);
        $result = $useCase->execute(1);

        $this->assertTrue($result);
    }

    public function test_execute_returns_false_when_repository_fails_to_delete_task()
    {
        $repo = $this->createMock(TaskDeleteRepositoryInterface::class);
        $repo->method('deleteRepo')->willReturn(false);

        $useCase = new TaskDeleteUseCase($repo);
        $result = $useCase->execute(1);

        $this->assertFalse($result);
    }
}
