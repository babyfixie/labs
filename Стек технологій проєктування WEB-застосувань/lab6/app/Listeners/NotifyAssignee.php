<?php

namespace App\Listeners;

use App\Events\TaskCreated;
use Illuminate\Support\Facades\Log;

class NotifyAssignee
{
    public function handle(TaskCreated $event): void
    {
        if ($event->task->assignee_id) {
            Log::info("Пользователю {$event->task->assignee_id} назначена задача: {$event->task->title}");
        }
    }
}