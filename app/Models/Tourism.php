<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tourism extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'location',
        'photo',
        'location_id',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
