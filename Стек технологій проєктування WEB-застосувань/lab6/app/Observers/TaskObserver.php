<?php

namespace App\Observers;

use App\Models\Task;
use Illuminate\Support\Facades\Log;

class TaskObserver
{
    public function created(Task $task): void
    {
        Log::info("Observer: Створено нову задачу ID: {$task->id}");
    }

    public function updated(Task $task): void
    {
        Log::info("Observer: Оновлено задачу ID: {$task->id}");
    }

    public function deleted(Task $task): void
    {
        Log::warning("Observer: Видалено задачу ID: {$task->id}");
    }
}