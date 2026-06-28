<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();          // مثال: branding, marketing, content, packaging
            $table->string('title');                    // عنوان الخدمة بالعربي
            $table->string('icon')->nullable();          // اسم الأيقونة (material symbol name)
            $table->text('description');                 // وصف الخدمة
            $table->string('badge')->nullable();          // مثال: "الأكثر طلباً"
            $table->string('cta_text')->nullable();       // نص رابط "استكشف..."
            $table->unsignedInteger('sort_order')->default(0); // ترتيب العرض بالصفحة
            $table->boolean('is_featured')->default(false);   // يظهر بحجم أكبر (lg:col-span-2)
            $table->boolean('is_active')->default(true);      // تفعيل/تعطيل الخدمة بدون حذفها
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
