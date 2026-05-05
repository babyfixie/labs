<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        return response()->json(Comment::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'content' => 'required|string|max:1000',
        ]);

        $comment = Comment::create($validated);
        return response()->json($comment, 201);
    }

    public function show(string $id)
    {
        return response()->json(Comment::findOrFail($id));
    }

    public function update(Request $request, string $id)
    {
        $comment = Comment::findOrFail($id);
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment->update($validated);
        return response()->json($comment);
    }

    public function destroy(string $id)
    {
        Comment::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}