<?php

declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Core\Task\UseCases\TaskDeleteUseCase;
use App\Core\Task\Repositories\Interfaces\TaskDeleteRepositoryInterface;

class TaskDeleteUseCaseTest extends TestCase
{
    public function testExecuteReturnsTrueWhenRepositoryDeletesSuccessfully()
    {
        $repo = $this->createMock(TaskDeleteRepositoryInterface::class);
        $repo->method('deleteRepo')->willReturn(true);

        $useCase = new TaskDeleteUseCase($repo);
        $result = $useCase->execute(1);

        $this->assertTrue($result);
    }

    public function testExecuteReturnsFalseWhenRepositoryFailsToDelete()
    {
        $repo = $this->createMock(TaskDeleteRepositoryInterface::class);
        $repo->method('deleteRepo')->willReturn(false);

        $useCase = new TaskDeleteUseCase($repo);
        $result = $useCase->execute(1);

        $this->assertFalse($result);
    }
}
