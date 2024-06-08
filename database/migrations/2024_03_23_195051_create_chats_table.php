<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        // إنشاء جدول chats لتخزين الرسائل بين المستخدمين
        Schema::create('chats', function (Blueprint $table) {
            $table->id(); // معرف فريد لكل رسالة
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // معرف المستخدم الذي أرسل الرسالة
            $table->foreignId('receiver_id')->constrained('users')->onDelete('cascade'); // معرف المستخدم المستلم
            $table->text('message'); // محتوى الرسالة
            $table->enum('seen', ['yes', 'no'])->default('no'); // حالة رؤية الرسالة
            $table->timestamps(); // حقولا created_at و updated_at
        });
    }

    public function down()
    {
        // حذف جدول chats إذا كان موجودًا
        Schema::dropIfExists('chats');
    }
};
