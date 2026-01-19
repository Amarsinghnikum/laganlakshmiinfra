<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLogin extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'ip_address', 
        'login_time'
    ];

    protected $casts = [
        'login_time' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }

}
