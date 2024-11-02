<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Exam extends Model
{
    use HasFactory;

    // Define fillable attributes
    protected $fillable = [
        'title',
        'subject_id',
        'class_id',
        'exam_date',     // Changed from 'date' to 'exam_date'
        'start_time',    // Changed from 'time' to 'start_time'
        'duration',
        'total_marks',
        'description',
    ];

    // Relationships
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    // Validation rules
    public static function validate(array $data)
    {
        return Validator::make($data, [
            'title' => 'required|string|max:255',
            'subject_id' => 'required|exists:subjects,id',
            'class_id' => 'required|exists:classes,id',
            'exam_date' => 'required|date',           // Changed to 'exam_date'
            'start_time' => 'required|string',        // Changed to 'start_time'
            'duration' => 'required|integer|min:1',
            'total_marks' => 'required|integer|min:1',
            'description' => 'nullable|string|max:500',
        ]);
    }

    // Custom methods

    // Get exams scheduled for a specific class
    public static function getExamsByClass($classId)
    {
        return self::where('class_id', $classId)->orderBy('exam_date')->get();
    }

    // Check if an exam has started
    public function hasStarted()
    {
        return now()->greaterThanOrEqualTo($this->exam_date . ' ' . $this->start_time);
    }

    // Check if an exam is completed (assuming completion is marked in results)
    public function isCompleted()
    {
        return $this->results()->where('status', 'completed')->exists();
    }

    // Get results for this exam
    public function getResults()
    {
        return $this->results()->with('student')->get();
    }
}
