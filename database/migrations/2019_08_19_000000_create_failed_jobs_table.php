<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        // إنشاء جدول failed_jobs لتخزين تفاصيل المهام الفاشلة
        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id(); // المعرف التلقائي
            $table->string('uuid')->unique(); // معرف فريد عالمي للوظيفة
            $table->text('connection'); // نوع الاتصال
            $table->text('queue'); // اسم الطابور
            $table->longText('payload'); // تفاصيل الوظيفة
            $table->longText('exception'); // تفاصيل الخطأ الذي تسبب بالفشل
            $table->timestamp('failed_at')->useCurrent(); // الوقت الذي فشلت فيه الوظيفة
        });
    }

    public function down()
    {
        // حذف جدول failed_jobs إذا كان موجودًا
        Schema::dropIfExists('failed_jobs');
    }
};
