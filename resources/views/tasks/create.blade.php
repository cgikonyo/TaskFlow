@extends('layouts.app')
@section('content')
    <h1>New Task</h1>
    <form method="POST" action="/tasks">
        <div class="'form-group>">
            @csrf
            <label for="description">Task Description</label>
            <input class="form-control" name="description" />
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" name="status">
                <option value="pending">Pending</option>
                <option value="started">Started</option>
                <option value="completed">Completed</option>
            </select>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Create Task</button>
        </div>

    </form>

@endsection
