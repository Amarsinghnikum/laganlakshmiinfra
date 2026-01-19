<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitorLog extends Model
{
    protected $fillable = [
        'visitor_hash',
        'ip',
        'country',
        'region',
        'city',
        'browser',
        'platform',
        'device',
        'visited_at'
    ];
}
