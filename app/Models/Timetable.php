<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Timetable extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'timetables';

    protected $fillable = [
        'name',
        'description',
        'semester_id',
        'class_id',
        'school_id',
    ];

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }


    public function slots():HasMany
    {
        return $this->hasMany(TimeTableTimeSlot::class,'timetable_id');
    }

    public function MyClass()
    {
        return $this->belongsTo(Classes::class,'class_id');
    }

    public function school()
    {
        return $this->belongsTo(School::class,'school_id');
    }

}
