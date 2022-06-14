<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Otp extends Model
{
    use HasFactory;
    public $table = 'users_otp';
    public $fillable = [
        "user_id",
        "code",
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
