<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        // إنشاء جدول projects لتخزين المشاريع
        Schema::create('projects', function (Blueprint $table) {
            $table->id(); // معرف فريد لكل مشروع
            $table->string('name'); // اسم المشروع
            $table->text('description'); // وصف المشروع
            $table->date('start_date'); // تاريخ بداية المشروع
            $table->date('end_date'); // تاريخ نهاية المشروع
            $table->enum('status', ['planned', 'ongoing', 'completed', 'on-hold', 'canceled'])->default('planned'); // حالة المشروع مع قيم محددة
            $table->string('photo')->nullable();
            $table->timestamps(); // حقولا created_at و updated_at
        });
    }

    public function down()
    {
        // حذف جدول projects إذا كان موجودًا
        Schema::dropIfExists('projects');

    }
};
