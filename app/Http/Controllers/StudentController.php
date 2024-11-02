<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // Display a listing of the students.
    public function index()
    {
        // You might want to paginate the results
        $students = Student::paginate(10); // Adjust the number as needed
        return view('students.index', compact('students'));
    }

    // Show the form for creating a new student.
    public function create()
    {
        return view('students.create'); // Ensure you have this view
    }

    // Store a newly created student in storage.
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string',
            'class_level' => 'required|string',
            'parent_name' => 'required|string|max:255',
            'parent_phone' => 'required|string|max:15',
            'parent_email' => 'required|email|max:255',
            'address' => 'nullable|string',
            'emergency_contact' => 'nullable|string',
            'medical_conditions' => 'nullable|string',
        ]);

        Student::create($validatedData);

        return redirect()->route('students.index')->with('success', 'Student added successfully!');
    }

    // Display the specified student.
    public function show(Student $student)
    {
        return view('students.show', compact('student')); // Ensure you have this view
    }

    // Show the form for editing the specified student.
    public function edit(Student $student)
    {
        return view('students.edit', compact('student')); // Ensure you have this view
    }

    // Update the specified student in storage.
    public function update(Request $request, Student $student)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string',
            'class_level' => 'required|string',
            'parent_name' => 'required|string|max:255',
            'parent_phone' => 'required|string|max:15',
            'parent_email' => 'required|email|max:255',
            'address' => 'nullable|string',
            'emergency_contact' => 'nullable|string',
            'medical_conditions' => 'nullable|string',
        ]);

        $student->update($validatedData);

        return redirect()->route('students.index')->with('success', 'Student updated successfully!');
    }

    // Remove the specified student from storage.
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }
}
