<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reading extends Model
{
    use HasFactory;

    protected $fillable = [
        'pulse_rate',
        'blood_saturation',
        'systolic',
        'diastolic',  
    ];

    //User Relationship

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
