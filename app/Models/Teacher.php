<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'admission_no',
        'gender',
        'phone',
        'dateofbirth',
        'current_address',
        'permanent_address',
    ];
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
