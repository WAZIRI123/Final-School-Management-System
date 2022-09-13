<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Classes extends Model
{
    use HasFactory;
    protected $table='classes';
    protected $fillable = [
        'class_name',
        'class_numeric',
        'teacher_id',
        'class_description'
    ];
    public function students():HasMany
    {
        return $this->hasMany(Student::class,'class_id');
    }
    public function subjects():BelongsToMany
    {
        return $this->belongsToMany(Subject::class);
    }
    public function teacher() :BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }
}
