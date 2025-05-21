<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Schedule extends Model
{
    protected $fillable = [
        'route_id',
        'bus_id',
        'departure_date',
        'departure_time',
        'duration',
        'price',
        'boarding_point',
        'food_break',
        'status',
        'delay_minutes',
        'status_reason'
    ];

    protected $casts = [
        'departure_date' => 'date',
        'departure_time' => 'datetime',
        'food_break' => 'array',
        'price' => 'decimal:2'
    ];

    public function route(): BelongsTo
    {
        return $this->belongsTo(BusRoute::class, 'route_id');
    }

    public function bus(): BelongsTo
    {
        return $this->belongsTo(Bus::class);
    }
}
