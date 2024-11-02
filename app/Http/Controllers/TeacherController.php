<?php 

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::paginate(10); // Adjust as needed
        return view('teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('teachers.create'); // Ensure this view exists
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            // Add other fields as necessary
        ]);

        Teacher::create($validatedData);
        return redirect()->route('teachers.index')->with('success', 'Teacher added successfully!');
    }

    public function show(Teacher $teacher)
    {
        return view('teachers.show', compact('teacher')); // Ensure this view exists
    }

    public function edit(Teacher $teacher)
    {
        return view('teachers.edit', compact('teacher')); // Ensure this view exists
    }

    public function update(Request $request, Teacher $teacher)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            // Add other fields as necessary
        ]);

        $teacher->update($validatedData);
        return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully!');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return redirect()->route('teachers.index')->with('success', 'Teacher deleted successfully!');
    }
}
