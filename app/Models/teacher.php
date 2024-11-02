<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'qualification',
        'subject_specialization',
        'employment_date',
        'employee_id',
        'status'
    ];

    protected $dates = [
        'employment_date',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function classes()
    {
        return $this->hasMany(ClassRoom::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'teacher_subject');
    }

    public function students()
    {
        return $this->hasManyThrough(Student::class, ClassRoom::class);
    }

    public function attendances()
    {
        return $this->hasMany(TeacherAttendance::class);
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($teacher) {
            $teacher->employee_id = 'TCH' . str_pad(static::max('id') + 1, 5, '0', STR_PAD_LEFT);
        });
    }
}
