<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // fetches all tasks from the database and returns the view
    public function index()
    {
        // We fetch ALL tasks as a collection called $tasks
        $tasks = auth()->user()->tasks;

        return view('tasks.index', compact('tasks'));
    }
    //shows the form to create amnew task
    public function create()
    {
        return view('tasks.create');
    }
    //handles actual creation of a new task
    public function store(Request $request)
    {
        // 1. Validate
        $request->validate([
            'description' => 'required|string|max:255',
            'status' => 'required|in:pending,started,completed',
        ]);

        // 2. Save using the User relationship
        // make sure a user is authenticated before trying to access the relation
        $user = auth()->user();
        if (!$user) {
            // this shouldn't happen if your routes are protected by auth middleware
            abort(403, 'Unauthenticated');
        }

        // get the next task number for this user
        $nextTaskNumber = $user->tasks()->max('task_number') + 1;

        $user->tasks()->create([
            'description' => $request->description,
            'status' => $request->status,
            'task_number' => $nextTaskNumber,
        ]);

        // 3. Redirect back
        return redirect()->back()->with('success', 'Task added!');
    }


    //Displays details for a specific task
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Update the specified task (mainly status changes).
     */
    public function update(Request $request, Task $task)
    {
        // ensure the authenticated user owns the task
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:pending,started,completed',
        ]);

        $task->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Task updated!');
    }
}
