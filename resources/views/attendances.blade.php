@extends('layout.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>Attendance List</h3>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAttendanceModal">Add New Attendance</button>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mb-3">
                        <form action="{{ route('attendance.index') }}" method="GET" class="form-inline">
                            <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request()->get('search') }}">
                            <button type="submit" class="btn btn-secondary">Search</button>
                        </form>
                    </div>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Event</th>
                                <th>Check In</th>
                                <th>Check Out</th>
                                <th>Status</th>
                                <th>Notes</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($attendances as $attendance)
                                <tr>
                                    <td>{{ $attendance->id }}</td>
                                    <td>{{ $attendance->user->full_name }}</td> <!-- User's full name -->
                                    <td>{{ $attendance->event->name }}</td> <!-- Event name -->
                                    <td>{{ $attendance->check_in ? $attendance->check_in->format('Y-m-d H:i:s') : 'N/A' }}</td>
                                    <td>{{ $attendance->check_out ? $attendance->check_out->format('Y-m-d H:i:s') : 'N/A' }}</td>
                                    <td>{{ ucfirst($attendance->status) }}</td>
                                    <td>{{ $attendance->notes }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editAttendanceModal" data-id="{{ $attendance->id }}" data-user="{{ $attendance->user->id }}" data-event="{{ $attendance->event->id }}" data-checkin="{{ $attendance->check_in }}" data-checkout="{{ $attendance->check_out }}" data-status="{{ $attendance->status }}" data-notes="{{ $attendance->notes }}">Edit</button>
                                            <form action="{{ route('attendance.destroy', $attendance->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this attendance record?')">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No attendance records found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center">
                        {{ $attendances->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Attendance Modal -->
<div class="modal fade" id="addAttendanceModal" tabindex="-1" aria-labelledby="addAttendanceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('attendance.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAttendanceModalLabel">Add Attendance</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="user_id" class="form-label">User</label>
                        <select name="user_id" class="form-select" required>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="event_id" class="form-label">Event</label>
                        <select name="event_id" class="form-select" required>
                            @foreach($events as $event)
                                <option value="{{ $event->id }}">{{ $event->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="check_in" class="form-label">Check In</label>
                        <input type="datetime-local" name="check_in" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="check_out" class="form-label">Check Out</label>
                        <input type="datetime-local" name="check_out" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="pending">Pending</option>
                            <option value="present">Present</option>
                            <option value="absent">Absent</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes</label>
                        <textarea name="notes" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Attendance</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit Attendance Modal -->
<div class="modal fade" id="editAttendanceModal" tabindex="-1" aria-labelledby="editAttendanceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('attendance.update', 'attendance_id') }}" method="POST" id="editAttendanceForm">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAttendanceModalLabel">Edit Attendance</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="attendance_id" id="attendance_id">
                    <div class="mb-3">
                        <label for="edit_user_id" class="form-label">User</label>
                        <select name="user_id" class="form-select" id="edit_user_id" required>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_event_id" class="form-label">Event</label>
                        <select name="event_id" class="form-select" id="edit_event_id" required>
                            @foreach($events as $event)
                                <option value="{{ $event->id }}">{{ $event->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_check_in" class="form-label">Check In</label>
                        <input type="datetime-local" name="check_in" class="form-control" id="edit_check_in" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_check_out" class="form-label">Check Out</label>
                        <input type="datetime-local" name="check_out" class="form-control" id="edit_check_out">
                    </div>
                    <div class="mb-3">
                        <label for="edit_status" class="form-label">Status</label>
                        <select name="status" class="form-select" id="edit_status">
                            <option value="pending">Pending</option>
                            <option value="present">Present</option>
                            <option value="absent">Absent</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_notes" class="form-label">Notes</label>
                        <textarea name="notes" class="form-control" rows="3" id="edit_notes"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Attendance</button>
                </div>
            </div>
        </form>
    </div>
</div>

@section('scripts')
<script>
    // Populate edit modal with existing data
    const editAttendanceModal = document.getElementById('editAttendanceModal');
    editAttendanceModal.addEventListener('show.bs.modal', (event) => {
        const button = event.relatedTarget; // Button that triggered the modal
        const id = button.getAttribute('data-id');
        const userId = button.getAttribute('data-user');
        const eventId = button.getAttribute('data-event');
        const checkIn = button.getAttribute('data-checkin');
        const checkOut = button.getAttribute('data-checkout');
        const status = button.getAttribute('data-status');
        const notes = button.getAttribute('data-notes');

        // Update the modal's content
        const form = document.getElementById('editAttendanceForm');
        form.action = form.action.replace('attendance_id', id);
        document.getElementById('attendance_id').value = id;
        document.getElementById('edit_user_id').value = userId;
        document.getElementById('edit_event_id').value = eventId;
        document.getElementById('edit_check_in').value = checkIn;
        document.getElementById('edit_check_out').value = checkOut;
        document.getElementById('edit_status').value = status;
        document.getElementById('edit_notes').value = notes;
    });
</script>
@endsection

@endsection
