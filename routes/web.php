<?php


use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// all task routes should be protected by authentication
Route::middleware(['auth'])->group(function () {
    Route::resource('tasks', TaskController::class);
});

// optionally serve a simple homepage - could redirect to tasks
Route::get('/', function () {
    return redirect()->route('tasks.index');
});

use App\Http\Controllers\AuthController;

// authentication routes (only available to guests)
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
});

// logout should be available to authenticated users
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

//replace the homepage
//Handle the task submission data
//Create a task
//Display a list of tasks
//Mark a task as completed
//Diveide the tasks into completed and uncompleted section
//Delete a task permanently
