<?php


use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/tasks', [TaskController::class, 'index'])->middleware('auth');

Route::get('/', function () {
    return view('tasks.index');
});

Route::get('/tasks/create', function () {
    return view('tasks.create');
});

Route::post('/tasks', [TaskController::class, 'store']);

//replace the homepage
//Handle the task submission data
//Create a task
//Display a list of tasks
//Mark a task as completed
//Diveide the tasks into completed and uncompleted section
//Delete a task permanently
