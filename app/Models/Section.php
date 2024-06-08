<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'manager',
        '' // يجب أن يكون manager_id لتحديد المفتاح الخارجي للمستخدم الذي يدير القسم
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    // علاقات إضافية أو طرق مخصصة يمكن إضافتها هنا.
}
