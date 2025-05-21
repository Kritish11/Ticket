<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bus extends Model
{
    protected $fillable = [
        'name',
        'standard_id',  // Changed from bus_standard_id
        'number_plate',
        'seats',
        'driver_name',
        'driver_license',
        'driver_bill_book',
        'images',
        'features'
    ];

    protected $casts = [
        'images' => 'array',
        'features' => 'array'
    ];

    public function standard(): BelongsTo
    {
        return $this->belongsTo(BusStandard::class, 'standard_id');  // Changed from bus_standard_id
    }
}
