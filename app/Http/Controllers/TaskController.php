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
        ]);

        // 2. Save using the User relationship
        auth()->user()->tasks()->create([
            'description' => $request->description,

        ]);

        // 3. Redirect back
        return redirect()->back()->with('success', 'Task added!');
    }


    //Displays details for a specific task
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }
}
