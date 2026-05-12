<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;

class CreateTaskInteractive extends Command
{

    protected $signature = 'tasks:create-interactive';


    protected $description = 'Інтерактивне створення нової задачі через консоль';


    public function handle()
    {
        $title = $this->ask('Введіть назву задачі');

        $description = $this->ask("Короткий опис (необов'язково)");

        $deadline = $this->ask('Дата дедлайну (в форматі YYYY-MM-DD)');

        $status = $this->choice(
            'Оберіть статус',
            ['new', 'in_progress', 'done'],
            0
        );

        $userId = $this->ask('ID виконавця (або залиште порожнім)');

        if ($this->confirm('Створити цю задачу?', true)) {

            $task = Task::create([
                'title' => $title,
                'description' => $description,
                'deadline' => $deadline,
                'status' => $status,
                'user_id' => $userId,
            ]);

            $this->info("Задача '{$task->title}' створена з ID: {$task->id}");
        } else {
            $this->warn("Створення задачі скасовано.");
        }
    }
}