<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use AjCastro\EagerLoadPivotRelations\EagerLoadPivotTrait;
use Illuminate\Database\Eloquent\Model;

class WeekDay extends Model
{
    use HasFactory;

    use EagerLoadPivotTrait;

    protected $fillable = [
        'name'
    ];


        //many to many relationship with week days
        public function timeSlots()
        {
            //get pivot table as timetableRecords
            return $this->belongsToMany(TimeTableTimeSlot::class)->as('timetableRecord')->withPivot(['subject_id'])->withTimestamps()->using(TimeTableRecord::class);
        }
}

