@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>Store New School Class</h3> <!-- Updated title -->
                        <a href="{{ route('SchoolClasses.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('SchoolClasses.store') }}" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="name">Class Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="description">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="teacher_id">Teacher</label>
                            <select class="form-control @error('teacher_id') is-invalid @enderror" id="teacher_id" name="teacher_id" required>
                                <option value="">Select a teacher</option>
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                        {{ $teacher->first_name }} {{ $teacher->last_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('teacher_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Store Class</button> <!-- Updated button text -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
