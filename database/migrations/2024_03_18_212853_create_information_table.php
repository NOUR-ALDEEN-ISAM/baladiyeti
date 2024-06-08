<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('information', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('seen');
            $table->text('message');
            $table->text('response');
            $table->string('employee');
            $table->timestamps();
    
            // إذا كان هناك علاقات خارجية، يمكنك إضافتها هنا
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('information');
    }
    
};
