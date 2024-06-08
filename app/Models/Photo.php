<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    protected $fillable = [
        'tourism_id', 
        'photo'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tourism()
    {
        return $this->belongsTo(Tourism::class, 'tourism_id'); 
    }
}
