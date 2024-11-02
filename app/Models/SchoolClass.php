<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SchoolClass extends Model
{
    
    use HasFactory, SoftDeletes;

    protected $table = 'classes';

    protected $fillable = [
        'name',
        'grade_level',
        'section',
        'teacher_id',
        'academic_year',
        'capacity',
        'is_active',
        'room_number',
        'schedule',
        'description',
        'curriculum_type',
        'learning_mode',
        'start_time',
        'end_time',
        'class_code',
        'max_students'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'schedule' => 'array',
        'capacity' => 'integer',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'max_students' => 'integer'
    ];

    // These dates will be automatically handled by Laravel's Eloquent
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    // Relationships
    public function teacher()
    {
        return $this->belongsTo(Teacher::class)->withTrashed(); // Include trashed teachers
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'class_student')
            ->withTimestamps()
            ->withPivot(['enrollment_date', 'status', 'enrollment_type', 'emergency_contact']);
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function assessments()
    {
        return $this->hasMany(Assessment::class);
    }

    public function learningMaterials()
    {
        return $this->hasMany(LearningMaterial::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeGradeLevel($query, $level)
    {
        return $query->where('grade_level', $level);
    }

    public function scopeCurrentAcademicYear($query)
    {
        return $query->where('academic_year', config('school.current_academic_year'));
    }

    // Methods
    public function isAtCapacity()
    {
        return $this->students()->count() >= $this->capacity;
    }

    public function availableSeats()
    {
        return max(0, $this->capacity - $this->students()->count());
    }

    public function enrollStudent($student, $enrollmentType = 'regular', $emergencyContact = null)
    {
        if (!$this->isAtCapacity()) {
            return $this->students()->attach($student, [
                'enrollment_date' => now(),
                'status' => 'active',
                'enrollment_type' => $enrollmentType,
                'emergency_contact' => $emergencyContact
            ]);
        }
        return false;
    }

    public function removeStudent($student)
    {
        return $this->students()->detach($student);
    }

    public function getFullNameAttribute()
    {
        return "Grade {$this->grade_level} - Section {$this->section} ({$this->academic_year})";
    }

    public function generateClassCode()
    {
        return strtoupper(uniqid('CLS'));
    }

    public function isClassInSession()
    {
        $now = now();
        return $now->between($this->start_time, $this->end_time);
    }

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($class) {
            $class->class_code = $class->generateClassCode();
        });
    }
}
