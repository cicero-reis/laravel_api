<?php

namespace App\Console\Commands;

use App\Core\Task\Services\Enums\DeliveryStatus;
use App\Models\Task;
use App\Models\TasksSummary;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ETLTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'etl:tasks';

    /**
     * The console command description.
     *
     * @var string
     */
     protected $description = 'ETL completo: summary, ranking, prioridade, status e JSON frontend';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Iniciando ETL completo...");

        $today = Carbon::today();
        $users = User::all();
        $summaryCollection = collect();

        // Processar cada usuário
        foreach ($users as $user) {
            $tasks = Task::where('user_id', $user->id)->get();

            $totalTasks = $tasks->count();
            $tasksCompleted = $tasks->where('is_completed', true)->count();
            $tasksPending = $tasks->where('is_completed', false)->count();
            $percentCompleted = $totalTasks > 0 ? round(($tasksCompleted / $totalTasks) * 100, 2) : 0;

            // Prioridade
            $tasksHigh = $tasks->where('priority', 'high')->count();
            $tasksMedium = $tasks->where('priority', 'medium')->count();
            $tasksLow = $tasks->where('priority', 'low')->count();

            // Prioridade atrasada
            $tasksOverdueHigh = $tasks->where('priority', 'high')->where('is_completed', false)->where('due_date', '<', $today)->count();
            $tasksOverdueMedium = $tasks->where('priority', 'medium')->where('is_completed', false)->where('due_date', '<', $today)->count();
            $tasksOverdueLow = $tasks->where('priority', 'low')->where('is_completed', false)->where('due_date', '<', $today)->count();

            // Status de entrega
            $withinDeadline = $tasks->where('is_completed', false)->where('due_date', '>', $today)->count();
            $dueToday = $tasks->where('is_completed', false)->where('due_date', '=', $today)->count();
            $overdue = $tasks->where('is_completed', false)->where('due_date', '<', $today)->count();

            // Salvar summary temporário
            $summaryCollection->push([
                'user_id' => $user->id,
                'total_tasks' => $totalTasks,
                'tasks_completed' => $tasksCompleted,
                'tasks_pending' => $tasksPending,
                'percent_completed' => $percentCompleted,
                'tasks_high_priority' => $tasksHigh,
                'tasks_medium_priority' => $tasksMedium,
                'tasks_low_priority' => $tasksLow,
                'tasks_overdue_high' => $tasksOverdueHigh,
                'tasks_overdue_medium' => $tasksOverdueMedium,
                'tasks_overdue_low' => $tasksOverdueLow,
                'tasks_within_deadline' => $withinDeadline,
                'tasks_due_today' => $dueToday,
                'tasks_overdue' => $overdue,
            ]);
        }

        // Ranking por produtividade (% concluído)
        $ranked = $summaryCollection->sortByDesc('percent_completed')->values();

        foreach ($ranked as $index => $item) {
            $item['rank'] = $index + 1;

            // Atualizar ou criar no DB
            TasksSummary::updateOrCreate(
                ['user_id' => $item['user_id']],
                $item
            );
        }

        $this->info("ETL completo atualizado com ranking e prioridade.");

        // Gerar JSON pronto para frontend
        $json = $ranked->map(function($item) {
            $status = DeliveryStatus::WITHIN_DEADLINE->value;
            $color = DeliveryStatus::WITHIN_DEADLINE->color();

            if ($item['tasks_overdue'] > 0) {
                $status = DeliveryStatus::OVERDUE->value;
                $color = DeliveryStatus::OVERDUE->color();
            } elseif ($item['tasks_due_today'] > 0) {
                $status = DeliveryStatus::DUE_TODAY->value;
                $color = DeliveryStatus::DUE_TODAY->color();
            }

            return [
                'user_id' => $item['user_id'],
                'total_tasks' => $item['total_tasks'],
                'tasks_completed' => $item['tasks_completed'],
                'tasks_pending' => $item['tasks_pending'],
                'percent_completed' => $item['percent_completed'],
                'tasks_high_priority' => $item['tasks_high_priority'],
                'tasks_medium_priority' => $item['tasks_medium_priority'],
                'tasks_low_priority' => $item['tasks_low_priority'],
                'tasks_overdue_high' => $item['tasks_overdue_high'],
                'tasks_overdue_medium' => $item['tasks_overdue_medium'],
                'tasks_overdue_low' => $item['tasks_overdue_low'],
                'tasks_within_deadline' => $item['tasks_within_deadline'],
                'tasks_due_today' => $item['tasks_due_today'],
                'tasks_overdue' => $item['tasks_overdue'],
                'rank' => $item['rank'],
                'delivery_status' => $status,
                'color' => $color,
            ];
        });

        // Salvar JSON no storage (opcional)
        #\Storage::disk('local')->put('tasks_summary.json', $json->toJson(JSON_PRETTY_PRINT));

        $this->info("JSON para frontend gerado: storage/app/tasks_summary.json");
    }
}
