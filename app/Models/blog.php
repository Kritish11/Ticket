<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class blog extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'subtitle',
        'featured_image',
        'content',
        'author_id',
        'status'
    ];
    public function author()
    {
        return $this->belongsTo(author::class);
    }
}
