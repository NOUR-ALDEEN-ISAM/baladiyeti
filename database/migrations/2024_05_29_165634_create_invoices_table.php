<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('id_num'); // معرف المستخدم
            $table->date('invoice_date'); // تاريخ الفاتورة
            $table->decimal('total_amount', 10, 2); // المبلغ الإجمالي
            $table->enum('status', ['مدفوعة', 'غير مدفوعة', 'مؤجلة', 'ملغية']); // حالة الفاتورة
            $table->enum('type', ['مياه', 'كهرباء', 'خدمات البلدية']); // نوع الفاتورة
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
}
