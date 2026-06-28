<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * جدول الإحصائيات — الأرقام الظاهرة في قسم Stats بالصفحة الرئيسية
     */
    public function up(): void
    {
        Schema::create('stats', function (Blueprint $table) {
            $table->id();

            $table->string('icon', 100);                   // اسم الأيقونة (Material Icons)
            $table->string('value', 50);                   // القيمة المعروضة مثل "120+" أو "24h"
            $table->string('label', 100);                  // التسمية مثل "عميل سعيد"

            $table->unsignedSmallInteger('sort_order')->default(0); // ترتيب العرض
            $table->boolean('is_active')->default(true);   // ظاهر / مخفي

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stats');
    }
};
