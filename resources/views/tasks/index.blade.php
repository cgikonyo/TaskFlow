@extends('layouts.app')

@section('content')
    <h1>Task List</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($tasks->isEmpty())
        <p>You have no tasks yet. <a href="{{ route('tasks.create') }}">Add one</a>.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th></th>Created</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                    <tr>
                        <td>{{ $task->task_number }}</td>
                        <td>{{ $task->description }}</td>
                        <td>
                            <form method="POST" action="{{ route('tasks.update', $task) }}">
                                @csrf
                                @method('PATCH')
                                <select name="status" class="form-select form-control" onchange="this.form.submit()">
                                    <option value="pending" {{ $task->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="started" {{ $task->status === 'started' ? 'selected' : '' }}>Started</option>
                                    <option value="completed" {{ $task->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                            </form>
                        </td>
                        <td>{{ $task->created_at->diffForHumans() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection