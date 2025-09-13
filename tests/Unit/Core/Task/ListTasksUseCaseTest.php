<?php

namespace Tests\Unit\Core\Task;

use App\Core\Task\Repositories\Interfaces\ListTasksRepositoryInterface;
use App\Core\Task\UseCases\ListTasksUseCase;
use PHPUnit\Framework\TestCase;

class ListTasksUseCaseTest extends TestCase
{
    public function test_execute_calls_repository_and_returns_result()
    {
        $filters = ['name' => 'Task'];

        $paginate = true;

        $expectedResult = [
            (object) ['id' => 1, 'name' => 'Task 1', 'is_completed' => false],
            (object) ['id' => 2, 'name' => 'Task 2', 'is_completed' => true],
        ];

        $mockRepository = $this->createMock(ListTasksRepositoryInterface::class);
        $mockRepository->expects($this->once())
            ->method('listRepo')
            ->with($filters, $paginate)
            ->willReturn($expectedResult);

        $useCase = new ListTasksUseCase($mockRepository);
        $result = $useCase->execute($filters, $paginate);

        $this->assertEquals($expectedResult, $result);
    }
}
