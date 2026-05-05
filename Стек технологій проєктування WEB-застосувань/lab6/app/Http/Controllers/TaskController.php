<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Events\TaskCreated;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return response()->json(Task::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable',
            'status' => 'required|in:new,in_progress,done',
            'project_id' => 'required|exists:projects,id',
            'assignee_id' => 'nullable|exists:users,id',
            'due_date' => 'nullable|date',
        ]);

        $task = Task::create($validated);
        event(new TaskCreated($task));

        return response()->json($task, 201);
    }

    public function show(string $id)
    {
        return response()->json(Task::findOrFail($id));
    }

    public function update(Request $request, string $id)
    {
        $task = Task::findOrFail($id);
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'status' => 'sometimes|required|in:new,in_progress,done',
            'project_id' => 'sometimes|required|exists:projects,id',
        ]);

        $task->update($validated);
        return response()->json($task);
    }

    public function destroy(string $id)
    {
        Task::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}