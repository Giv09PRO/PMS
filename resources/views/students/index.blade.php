@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>Students List</h3>
                        <a href="{{ route('students.create') }}" class="btn btn-primary">Add New Student</a>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Class</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($students as $student)
                                <tr>
                                    <td>{{ $student->id }}</td>
                                    <td>{{ $student->full_name }}</td> <!-- Using the full_name accessor -->
                                    <td>{{ $student->parent_email }}</td> <!-- Corresponds to parent_email field -->
                                    <td>{{ $student->parent_phone }}</td> <!-- Corresponds to parent_phone field -->
                                    <td>{{ optional($student->class)->name }}</td> <!-- Assuming class() returns ClassRoom model -->
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="{{ route('students.show', $student->id) }}" class="btn btn-info btn-sm">View</a>
                                            <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this student?')">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No students found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center">
                        {{ $students->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
