<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promotion extends Model
{
    use HasFactory,SoftDeletes;
    
    protected $fillable = [
        'old_class_id',
        'new_class_id',
        'old_section',
        'new_section',
        'academic_year_id',
        'student_id',
        'school_id',
    ];

    public function getLabelAttribute()
    {
        return "{$this->oldClass->name}  to {$this->newClass->name}  year: {$this->academicYear->start_year} - {$this->academicYear->stop_year}";
    }
    public function oldClass():BelongsTo
    {
        return $this->belongsTo(Classes::class, 'old_class_id');
    }

    public function newClass():BelongsTo
    {
        return $this->belongsTo(Classes::class, 'new_class_id');
    }

    public function student():BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class, 'academic_year_id');
    }
}
