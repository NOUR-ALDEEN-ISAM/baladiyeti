<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    // تحديد اسم الجدول إذا كان يختلف عن الاسم الافتراضي
    protected $table = 'invoices';

    // تحديد الحقول القابلة للتعبئة
    protected $fillable = [
        'id_num',
        'invoice_date',
        'total_amount',
        'status',
        'type',
    ];


    public function user()
    {
         return $this->belongsTo(User::class, 'id_num', 'id_num');
     }
}
