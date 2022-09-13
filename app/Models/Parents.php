<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Parents extends Model
{
    use HasFactory;
    protected $table = 'parents';
    protected $fillable = [
        'user_id',
        'gender',
        'admission_no',
        'phone',
        'current_address',
        'permanent_address',
    ];
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function students():HasMany
    {
        return $this->hasMany(Student::class, 'parent_id');
    }
}
