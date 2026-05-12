<?php

namespace App\Providers;

use App\Models\Task;
use App\Observers\TaskObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Реєструємо обсервер для моделі Task
        Task::observe(TaskObserver::class);
    }

}
