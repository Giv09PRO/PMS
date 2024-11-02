<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student; // Import the Student model
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the attendance records.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch all attendance records, you can also apply pagination if needed
        $attendances = Attendance::with('student')->get();
        return view('attendances.index', compact('attendances'));
    }

    /**
     * Show the form for creating a new attendance record.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $students = Student::all(); // Fetch all students for the dropdown
        return view('attendance.create', compact('students'));
    }

    /**
     * Store a newly created attendance record in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:students,id',
            'event_id' => 'required|exists:events,id', // Assuming you have an events table
            'check_in' => 'nullable|date',
            'check_out' => 'nullable|date',
            'status' => 'required|in:pending,present,absent',
            'notes' => 'nullable|string',
        ]);

        Attendance::create($request->all());

        return redirect()->route('attendance.index')->with('success', 'Attendance record created successfully.');
    }

    /**
     * Display the specified attendance record.
     *
     * @param  Attendance  $attendance
     * @return \Illuminate\View\View
     */
    public function show(Attendance $attendance)
    {
        return view('attendance.show', compact('attendance'));
    }

    /**
     * Show the form for editing the specified attendance record.
     *
     * @param  Attendance  $attendance
     * @return \Illuminate\View\View
     */
    public function edit(Attendance $attendance)
    {
        $students = Student::all(); // Fetch all students for the dropdown
        return view('attendance.edit', compact('attendance', 'students'));
    }

    /**
     * Update the specified attendance record in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Attendance  $attendance
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Attendance $attendance)
    {
        $request->validate([
            'user_id' => 'required|exists:students,id',
            'event_id' => 'required|exists:events,id',
            'check_in' => 'nullable|date',
            'check_out' => 'nullable|date',
            'status' => 'required|in:pending,present,absent',
            'notes' => 'nullable|string',
        ]);

        $attendance->update($request->all());

        return redirect()->route('attendance.index')->with('success', 'Attendance record updated successfully.');
    }

    /**
     * Remove the specified attendance record from storage.
     *
     * @param  Attendance  $attendance
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        return redirect()->route('attendance.index')->with('success', 'Attendance record deleted successfully.');
    }
}
