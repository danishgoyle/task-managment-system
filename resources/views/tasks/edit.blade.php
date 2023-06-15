@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center">Edit Task</h1>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ $task->title }}">
                    </div>

                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea name="description" id="description" class="form-control">{{ $task->description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="completed">Completed:</label>
                        <div>
                            <input type="radio" name="completed" value="1" id="completed_yes" {{ $task->completed ? 'checked' : '' }}>
                            <label for="completed_yes">Yes</label>
                        </div>
                        <div>
                            <input type="radio" name="completed" value="0" id="completed_no" {{ !$task->completed ? 'checked' : '' }}>
                            <label for="completed_no">No</label>
                        </div>
                    </div>  

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
