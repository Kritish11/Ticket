<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusRoute extends Model
{
    use HasFactory;

    protected $fillable = [
        'from',
        'to',
        'distance',
        'duration',
        'status',
        'routeImage'
    ];

    protected $casts = [
        'status' => 'boolean',
        'distance' => 'float'
    ];
}
