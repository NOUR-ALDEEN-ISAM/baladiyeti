<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        // إنشاء جدول reviews لتخزين المراجعات المتعلقة بالمستخدمين ووجهات السياحة
        Schema::create('reviews', function (Blueprint $table) {
            $table->id(); // معرف فريد لكل مراجعة
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // معرف خارجي للمستخدم الذي كتب المراجعة
            $table->foreignId('tourism_id')->constrained()->onDelete('cascade'); // معرف خارجي للكيان السياحي الذي يجري تقييمه
            $table->double('rate', 3, 2); // درجة التقييم (عادة من 1 إلى 5)، مع دقة قصوى من رقمين بعد الفاصلة
            $table->text('comment'); // نص المراجعة
            $table->timestamps(); // حقولا created_at و updated_at
        });
    }

    public function down()
    {
        // حذف جدول reviews إذا كان موجودًا
        Schema::dropIfExists('reviews');
    }
};
