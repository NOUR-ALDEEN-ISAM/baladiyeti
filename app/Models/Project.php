<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'status',
        'photo',
        'manager_id'
    ];

    // العلاقات مع النماذج الأخرى إذا كانت موجودة
    // على سبيل المثال، علاقة مع المستخدمين (مدير المشروع)
    public function Section()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
}
