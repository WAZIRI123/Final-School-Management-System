<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcademicYear extends Model
{
    use HasFactory,SoftDeletes;
    
    protected $fillable = [
        'start_year',
        'stop_year',
        'school_id',
    ];

    public function name()
    {
        return "$this->start_year - $this->stop_year";
    }
    
    public function school():BelongsTo
    {
        return $this->belongsTo(School::class);
    }

        //semesters
        public function semesters():HasMany
        {
            return $this->hasMany(Semester::class);
        }
}
