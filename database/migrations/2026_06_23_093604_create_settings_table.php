<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();   // مثال: contact_email, contact_phone, hero_title, instagram_url
            $table->text('value')->nullable();
            $table->string('type')->default('text'); // text, textarea, image, url - يساعد لوحة التحكم تعرض الحقل الصحيح
            $table->string('group')->default('general'); // general, hero, contact, social - لتنظيم لوحة التحكم
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
