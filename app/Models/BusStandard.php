<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusStandard extends Model
{
    protected $fillable = ['name', 'description'];

    public function buses()
    {
        return $this->hasMany(Bus::class);
    }
}
