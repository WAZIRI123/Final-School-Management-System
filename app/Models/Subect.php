<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subect extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name', 'subject_code', 'school_id', 'class_id',
    ];


    public function classes():BelongsTo
    {
        return $this->belongsTo(Classes::class);
    }

    public function school():BelongsTo
    {
        return $this->belongsTo(School::class);
    }


}
