<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TimeTableRecord extends Pivot
{
    use HasFactory;

    public function subjects():BelongsTo
    {
        return $this->belongsTo(Subject::class,'subject_id');
    }
}
