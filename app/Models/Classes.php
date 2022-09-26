<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classes extends Model
{
    use HasFactory,SoftDeletes;
    protected $table='classes';

    protected $fillable = [
        'class_name',
        'class_code',
        'school_id',
        'section',
        'class_description'
    ];

    public function students():HasMany
    {
        return $this->hasMany(Student::class,'class_id');
    }

    // public function subjects():BelongsToMany
    // {
    //     return $this->belongsToMany(Subject::class);
    // }

    public function teacher() :BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public function school() :BelongsTo
    {
        return $this->belongsTo(School::class);
    }
}
