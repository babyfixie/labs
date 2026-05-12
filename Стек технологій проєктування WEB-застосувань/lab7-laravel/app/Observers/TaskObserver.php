<?php

namespace App\Observers;

use App\Models\Task;
use Illuminate\Support\Facades\Log;

class TaskObserver
{
    public function created(Task $task): void
    {
        Log::info("TaskObserver: Задача '{$task->title}' была успешно создана через Artisan команду.");
    }

    public function updated(Task $task): void
    {
    }
    public function deleted(Task $task): void
    {
    }
}