<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;

class GenerateTaskReport extends Command
{
    /**
     *
     * @var string
     */
    protected $signature = 'tasks:report {--project_id= : ID конкретного проєкту}';

    /**
     *
     * @var string
     */
    protected $description = 'Генерація звіту по задачам у вигляді таблиці';

    public function handle()
    {
        $projectId = $this->option('project_id');

        $query = Task::query();

        if ($projectId) {
            $query->where('project_id', $projectId);
        }

        $tasks = $query->get(['id', 'title', 'status', 'deadline']);

        if ($tasks->isEmpty()) {
            $this->warn("Задач не знайдено.");
            return;
        }

        $this->info("Звіт по задачам:");

        $this->table(
            ['ID', 'Назва', 'Статус', 'Дедлайн'],
            $tasks->toArray()
        );
    }
}