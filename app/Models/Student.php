<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id',
        'parent_id',
        'admission_no',
        'class_id',
        'gender',
        'phone',
        'dateofbirth',
        'current_address',
        'permanent_address',
    ];
    public function user():BelongsTo 
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function parent():BelongsTo
    {
        return $this->belongsTo(Parents::class,'parent_id');
    }

    public function class():BelongsTo
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    // public function attendances():HasMany
    // {
    //     return $this->hasMany(Attendance::class);
    // }
}
