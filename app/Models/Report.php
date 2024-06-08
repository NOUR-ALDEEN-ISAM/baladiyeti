<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_num',
        'section_id',
        'text_1',
        'photo_1',
        'seen',
        'photo_2',
        'text_2',
        'location',
        'report_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_num', 'id_num'); // افترض أن معرف المستخدم هو 'id_num'
    }
    

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
