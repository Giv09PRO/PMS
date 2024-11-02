<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'attendances'; // Define the table name if it's not the plural of the model name

    protected $fillable = [
        'student_id',
        'class_id',
        'date',
        'status',
        'notes',
    ];

    protected $casts = [
        'date' => 'datetime',
        'status' => 'string',
    ];

    protected $dates = [
        'deleted_at', // For soft deletes
    ];

    // Relationships
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    // Scopes
    public function scopePresent($query)
    {
        return $query->where('status', 'present');
    }

    public function scopeAbsent($query)
    {
        return $query->where('status', 'absent');
    }

    public function scopeLate($query)
    {
        return $query->where('status', 'late');
    }

    public function markAttendance($studentId, $classId, $date, $status, $notes = null)
    {
        return $this->create([
            'student_id' => $studentId,
            'class_id' => $classId,
            'date' => $date,
            'status' => $status,
            'notes' => $notes,
        ]);
    }

    public static function getAttendanceByDate($classId, $date)
    {
        return self::where('class_id', $classId)
                    ->whereDate('date', $date)
                    ->with(['student', 'schoolClass'])
                    ->get();
    }
}
