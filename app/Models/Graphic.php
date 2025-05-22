<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Graphic extends Model
{
    protected $fillable = [
        'title',
        'image',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean' // Cast status to boolean for 1/0 handling
    ];
}
