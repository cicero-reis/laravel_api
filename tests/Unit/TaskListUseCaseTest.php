<?php

namespace Tests\Unit;

use App\Core\Task\Repositories\Interfaces\TaskListRepositoryInterface;
use App\Core\Task\UseCases\TaskListUseCase;
use PHPUnit\Framework\TestCase;

class TaskListUseCaseTest extends TestCase
{
    public function test_execute_calls_repository_and_returns_result()
    {
        $filters = ['name' => 'Task'];

        $paginate = true;

        $expectedResult = [
            (object) ['id' => 1, 'name' => 'Task 1', 'is_completed' => false],
            (object) ['id' => 2, 'name' => 'Task 2', 'is_completed' => true],
        ];

        $mockRepository = $this->createMock(TaskListRepositoryInterface::class);
        $mockRepository->expects($this->once())
            ->method('listRepo')
            ->with($filters, $paginate)
            ->willReturn($expectedResult);

        $useCase = new TaskListUseCase($mockRepository);
        $result = $useCase->execute($filters, $paginate);

        $this->assertEquals($expectedResult, $result);
    }
}
