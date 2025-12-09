<?php

namespace App\Http\Controllers\Api\V1\ETL;

use App\Core\ETL\Services\TaskTransformService;
use App\Core\Task\UseCases\Interfaces\TaskETLUseCaseInterface;
use App\Http\Controllers\Controller;
use App\Models\Task;

class ETLController extends Controller
{
    protected $useCase;

    public function __construct(TaskETLUseCaseInterface $useCase)
    {
        $this->useCase = $useCase;
    }

    public function transformTasks(TaskTransformService $transformer)
    {
        $tasks = $this->useCase->execute();

        $result = $tasks->map(fn ($task) => $transformer->transform($task));

        return response()->json($result);
    }

    // public function dashboard(TaskTransformService $transformer)
    // {
    //     $tasks = Task::with('user')->get();

    //     $transformed = $tasks->map(fn ($task) => $transformer->transform($task));

    //     // Dados agregados para cards
    //     $summary = [
    //         'within_deadline' => $transformed->where('status', 'Within deadline')->count(),
    //         'due_today' => $transformed->where('status', 'Due today')->count(),
    //         'overdue' => $transformed->where('status', 'Overdue')->count(),
    //         'total' => $transformed->count(),
    //     ];

    //     return response()->json([
    //         'summary' => $summary,
    //         'tasks' => $transformed,
    //     ]);
    // }
}
