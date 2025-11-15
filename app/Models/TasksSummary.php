<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TasksSummary extends Model
{
    protected $fillable = [
        'user_id',
        'total_tasks',
        'tasks_completed',
        'tasks_pending',
        'percent_completed',
        'tasks_high_priority',
        'tasks_medium_priority',
        'tasks_low_priority',
        'tasks_overdue_high',
        'tasks_overdue_medium',
        'tasks_overdue_low',
        'tasks_within_deadline',
        'tasks_due_today',
        'tasks_overdue',
        'rank',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
