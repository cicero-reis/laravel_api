<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks_summaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->integer('total_tasks')->default(0);
            $table->integer('tasks_completed')->default(0);
            $table->integer('tasks_pending')->default(0);
            $table->decimal('percent_completed', 5, 2)->default(0);
            $table->integer('tasks_high_priority')->default(0);
            $table->integer('tasks_medium_priority')->default(0);
            $table->integer('tasks_low_priority')->default(0);
            $table->integer('tasks_overdue_high')->default(0);
            $table->integer('tasks_overdue_medium')->default(0);
            $table->integer('tasks_overdue_low')->default(0);
            $table->integer('tasks_within_deadline')->default(0);
            $table->integer('tasks_due_today')->default(0);
            $table->integer('tasks_overdue')->default(0);
            $table->integer('rank')->nullable(); // ranking por produtividade
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks_summaries');
    }
};
