<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BusFeature extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    protected $guarded = ['id'];

    public function buses()
    {
        return $this->belongsToMany(Bus::class, 'bus_bus_feature');
    }
}
