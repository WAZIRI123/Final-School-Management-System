<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamRecord extends Model
{
    use HasFactory,SoftDeletes;
    
    protected $fillable = [
        'semester_id',
        'class_id',
        'section_id',
        'exam_id',
        'subject_id',
        'student_id',
        'academic_id',
        'marks',
        'rank',
    ];
    
    public function classes():BelongsTo
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }
    public function exams():BelongsTo
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }

    public function subjects():BelongsTo
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function students():BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function semester():BelongsTo
    {
        return $this->belongsTo(Semester::class, 'semester_id');
    }
    // academicYear()
    public function academicYear():BelongsTo
    {
        return $this->belongsTo(AcademicYear::class,'academic_id');
    }

}
