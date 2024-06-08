<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        // إنشاء جدول jobs لتخزين الوظائف والمهارات المتعلقة بكل وظيفة
        Schema::create('jobs', function (Blueprint $table) {
            $table->id(); // معرف فريد لكل وظيفة
            $table->string('name'); // اسم الوظيفة
            $table->text('skills'); // المهارات المطلوبة، كحقل نصي
            $table->enum('status', ['open', 'closed', 'pending'])->default('open'); // حالة الوظيفة مع قيم محددة
            $table->foreignId('section_id')->constrained()->onDelete('cascade'); // معرف خارجي يربط الوظيفة بالقسم
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // تأكد من وجود هذا الحقل
            $table->timestamps(); // حقولا created_at و updated_at
        });
    }

    public function down()
    {
        // حذف جدول jobs إذا كان موجودًا
        Schema::dropIfExists('jobs');
    }
};
