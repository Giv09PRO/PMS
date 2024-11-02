<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use Illuminate\Http\Request;

class SchoolClassController extends Controller
{
    // Display a listing of the school classes
    public function index()
    {
        $schoolclasses = SchoolClass::paginate(10);
        return view('SchoolClasses.index', compact('schoolclasses'));
    }

    // Show the form for creating a new school class
    public function create()
    {
        return view('schoolclasses.create');
    }

    // Store a newly created school class in storage
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'grade_level' => 'required|string|max:255',
            'capacity' => 'required|integer',
            'teacher_name' => 'required|string|max:255',
            'room_number' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'schedule' => 'nullable|string',
        ]);

        SchoolClass::create($validatedData);

        return redirect()->route('schoolclasses.index')->with('success', 'School Class added successfully!');
    }

    // Display the specified school class
    public function show(SchoolClass $schoolclass)
    {
        return view('schoolclasses.show', compact('schoolclass'));
    }

    // Show the form for editing the specified school class
    public function edit(SchoolClass $schoolclass)
    {
        return view('schoolclasses.edit', compact('schoolclass'));
    }

    // Update the specified school class in storage
    public function update(Request $request, SchoolClass $schoolclass)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'grade_level' => 'required|string|max:255',
            'capacity' => 'required|integer',
            'teacher_name' => 'required|string|max:255',
            'room_number' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'schedule' => 'nullable|string',
        ]);

        $schoolclass->update($validatedData);

        return redirect()->route('schoolclasses.index')->with('success', 'School Class updated successfully!');
    }

    // Remove the specified school class from storage
    public function destroy(SchoolClass $schoolclass)
    {
        $schoolclass->delete();

        return redirect()->route('schoolclasses.index')->with('success', 'School Class deleted successfully!');
    }
}
