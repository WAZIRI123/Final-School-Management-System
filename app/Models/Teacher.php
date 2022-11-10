<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id',
        'admission_no',
        'gender',
        'class_id',
        'phone',
        'dateofbirth',
        'current_address',
        'permanent_address',
    ];
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function class():BelongsTo
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function subjects():HasMany
    {
        return $this->hasMany(Subject::class, 'teacher_id');
    }
    
}
