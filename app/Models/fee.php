<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'student_id',
        'fee_type',
        'amount',
        'due_date',
        'payment_status',
        'payment_date',
        'academic_year',
        'term',
        'description',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'due_date' => 'datetime',
        'payment_date' => 'datetime',
        'amount' => 'decimal:2'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function scopeUnpaid($query)
    {
        return $query->where('payment_status', 'unpaid');
    }

    public function scopePaid($query)
    {
        return $query->where('payment_status', 'paid');
    }

    public function scopeOverdue($query)
    {
        return $query->where('due_date', '<', now())
                    ->where('payment_status', 'unpaid');
    }
}
