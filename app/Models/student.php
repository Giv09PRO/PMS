<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'admission_number',
        'first_name',
        'last_name',
        'date_of_birth',
        'gender',
        'class_level',
        'parent_name',
        'parent_phone',
        'parent_email',
        'address',
        'emergency_contact',
        'medical_conditions',
        'enrollment_date',
        'status'
    ];

    protected $dates = [
        'date_of_birth',
        'enrollment_date',
        'deleted_at'
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'enrollment_date' => 'date',
        'status' => 'boolean'
    ];

    // Relationships
    public function class()
    {
        return $this->belongsTo(ClassRoom::class, 'class_level');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    // Accessors
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeInClass($query, $classLevel)
    {
        return $query->where('class_level', $classLevel);
    }

    // Model Events
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($student) {
            if (empty($student->admission_number)) {
                $student->admission_number = 'STD' . date('Y') . str_pad(static::max('id') + 1, 4, '0', STR_PAD_LEFT);
            }
        });
    }
}
