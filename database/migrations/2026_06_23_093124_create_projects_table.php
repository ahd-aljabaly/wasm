<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
            $table->string('slug')->unique();           // لرابط صفحة المشروع المستقلة لاحقاً
            $table->string('title');                     // مثال: مجموعة مطاعم ومطابخ الزيتون
            $table->string('client_name')->nullable();    // اسم العميل الفعلي
            $table->string('category_label');             // النص المعروض بالـ badge، مثال: "هوية بصرية كاملة"
            $table->text('short_description');             // الوصف القصير تحت العنوان بالكارد
            $table->text('full_description')->nullable();   // وصف تفصيلي لصفحة المشروع المستقلة
            $table->string('cover_image')->nullable();       // مسار صورة الغلاف (storage/app/public/projects/...)
            $table->json('gallery_images')->nullable();       // مصفوفة صور إضافية لصفحة المشروع
            $table->string('accent_color')->default('#172E66'); // لون الخلفية البديل لو ما فيه صورة
            $table->boolean('is_featured')->default(false);     // يظهر بحجم كبير بالشبكة (md:col-span-4)
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_published')->default(true);     // مسودة/منشور
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
