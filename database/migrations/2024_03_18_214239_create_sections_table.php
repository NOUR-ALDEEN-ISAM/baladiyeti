<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        // إنشاء جدول sections لتخزين معلومات الأقسام
        Schema::create('sections', function (Blueprint $table) {
            $table->id(); // معرف فريد لكل قسم
            $table->string('name', 100); // اسم القسم بطول أقصى 100 حرف
            $table->string('manager'); // مدير القسم، يمكن أن يكون فارغًا
            $table->timestamps(); // حقولا created_at و updated_at
        });
    }

    public function down()
    {
        // حذف جدول sections إذا كان موجودًا
        Schema::dropIfExists('sections');
    }
};
