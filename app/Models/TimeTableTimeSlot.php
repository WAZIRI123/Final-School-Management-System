<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use AjCastro\EagerLoadPivotRelations\EagerLoadPivotTrait;

class TimeTableTimeSlot extends Model
{
    use HasFactory,SoftDeletes;
    use EagerLoadPivotTrait;

    protected $fillable = [
        'start_time',
        'stop_time',
        'timetable_id',
    ];

    public function timetable()
    {
        return $this->belongsTo(Timetable::class,'timetable_id');
    }

    //many to many relationship with week days
    public function weekdays()
    {
        //get pivot table as timetableRecords
        return $this->belongsToMany(WeekDay::class)->as('timetableRecord')->withPivot(['subject_id'])->withTimestamps()->using(TimeTableRecord::class);
    }
}
