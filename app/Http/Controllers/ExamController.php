<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Subject;
use App\Models\SchoolClass;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index()
    {
        $exams = Exam::all();
        return view('exams.index', compact('exams'));
    }

    public function create()
    {
        $subjects = Subject::all();
        $classes = SchoolClass::all();
        return view('exams.create', compact('subjects', 'classes'));
    }

    public function store(Request $request)
    {
        $validatedData = Exam::validate($request->all());
        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        // Create the exam using mapped attributes
        Exam::create([
            'title' => $request->input('title'),
            'subject_id' => $request->input('subject_id'),
            'class_id' => $request->input('class_id'),
            'exam_date' => $request->input('exam_date'),
            'start_time' => $request->input('start_time'),
            'duration' => $request->input('duration'),
            'total_marks' => $request->input('total_marks'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('exams.index')->with('success', 'Exam created successfully.');
    }

    public function show(Exam $exam)
    {
        return view('exams.show', compact('exam'));
    }

    public function edit(Exam $exam)
    {
        $subjects = Subject::all();
        $classes = SchoolClass::all();
        return view('exams.edit', compact('exam', 'subjects', 'classes'));
    }

    public function update(Request $request, Exam $exam)
    {
        $validatedData = Exam::validate($request->all());
        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        // Update the exam with mapped attributes
        $exam->update([
            'title' => $request->input('title'),
            'subject_id' => $request->input('subject_id'),
            'class_id' => $request->input('class_id'),
            'exam_date' => $request->input('exam_date'),
            'start_time' => $request->input('start_time'),
            'duration' => $request->input('duration'),
            'total_marks' => $request->input('total_marks'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('exams.index')->with('success', 'Exam updated successfully.');
    }

    public function destroy(Exam $exam)
    {
        $exam->delete();
        return redirect()->route('exams.index')->with('success', 'Exam deleted successfully.');
    }
}
