<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        // إنشاء جدول personal_access_tokens لتخزين رموز الوصول الشخصية
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id(); // معرف فريد للرمز
            $table->morphs('tokenable'); // الكيان الذي يملك الرمز
            $table->string('name'); // اسم الرمز
            $table->string('token', 64)->unique(); // رمز فريد بحجم 64 حرفًا
            $table->text('abilities')->nullable(); // صلاحيات الرمز
            $table->timestamp('last_used_at')->nullable(); // آخر مرة استخدم فيها الرمز
            $table->timestamp('expires_at')->nullable(); // تاريخ انتهاء صلاحية الرمز
            $table->timestamps(); // حقول created_at و updated_at
        });
    }

    public function down()
    {
        // حذف جدول personal_access_tokens إذا كان موجودًا
        Schema::dropIfExists('personal_access_tokens');
    }
};
