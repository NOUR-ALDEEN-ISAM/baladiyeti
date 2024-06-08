<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        // إنشاء جدول reports لتخزين التقارير المتعلقة بالمستخدمين والأقسام
        Schema::create('reports', function (Blueprint $table) {
            $table->id(); // معرف فريد لكل تقرير
            $table->integer('id_num'); // معرف خارجي للمستخدم
            $table->foreignId('section_id')->constrained()->onDelete('cascade'); // معرف خارجي للقسم
            $table->text('text_1'); // النص الرئيسي في التقرير
            $table->string('photo_1'); // الصورة الرئيسية في التقرير
            $table->enum('seen', ['yes', 'no'])->default('no'); // حالة رؤية التقرير
            $table->string('photo_2')->nullable(); // صورة إضافية اختيارية
            $table->text('text_2')->nullable(); // نص إضافي اختياري
            $table->string('location'); // موقع التقرير
            $table->date('report_date'); // تاريخ التقرير
            $table->timestamps(); // حقولا created_at و updated_at
        });
    }

    public function down()
    {
        // حذف جدول reports إذا كان موجودًا
        Schema::dropIfExists('reports');
    }
};
