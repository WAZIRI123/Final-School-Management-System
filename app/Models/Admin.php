<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Model
{
    use HasFactory,SoftDeletes;
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
