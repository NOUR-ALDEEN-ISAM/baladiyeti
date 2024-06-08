<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        // إنشاء جدول photos لتخزين الصور المتعلقة بالكيان tourism
        Schema::create('photos', function (Blueprint $table) {
            $table->id(); // معرف فريد لكل صورة
            $table->string('photo'); // اسم ملف أو مسار الصورة
            $table->foreignId('tourism_id')->constrained()->onDelete('cascade'); // معرف خارجي للكيان tourism
            $table->timestamps(); // حقولا created_at و updated_at
        });
    }

    public function down()
    {
        // حذف جدول photos إذا كان موجودًا
        Schema::dropIfExists('photos');
    }
};
