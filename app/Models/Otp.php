<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Otp extends Model
{
    use SoftDeletes;
    const MINUTES = 10;
    protected $table = 'otps';
    protected $fillable = [
        'user_id', 'otp', 'event', 'available_until'
    ];

}
