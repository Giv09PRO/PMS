@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-between">
        <div class="col-md-8">
            <h3>School Classes</h3>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('SchoolClasses.create') }}" class="btn btn-primary">Create New Class</a>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($schoolclasses as $schoolclass)
                    <tr>
                        <td>{{ $schoolclass->id }}</td>
                        <td>{{ $schoolclass->name }}</td>
                        <td>
                            <a href="{{ route('classes.edit', $schoolclass->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <!-- Add a delete button or link as necessary -->
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
