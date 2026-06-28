<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('company')->nullable();
            $table->string('email');
            $table->string('phone');
            $table->foreignId('service_id')->nullable()->constrained('services')->onDelete('set null'); // الخدمة المطلوبة
            $table->text('message')->nullable();
            $table->enum('status', ['new', 'contacted', 'in_progress', 'closed'])->default('new'); // لمتابعة حالة الطلب من لوحة التحكم
            $table->string('ip_address')->nullable();
            $table->boolean('email_sent')->default(false); // هل نجح إرسال إيميل الإشعار فعلياً
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_submissions');
    }
};
