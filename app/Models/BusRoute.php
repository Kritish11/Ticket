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

    protected $attributes = [
        'status' => true // Default value for new routes
    ];

    protected $casts = [
        'status' => 'boolean',
        'distance' => 'float'
    ];

    // Optional: Add accessor for human-readable status
    public function getStatusTextAttribute()
    {
        return $this->status ? 'active' : 'inactive';
    }
}
