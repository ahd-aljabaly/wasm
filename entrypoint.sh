#!/bin/sh

# الانتظار لثوانٍ بسيطة للتأكد من استقرار قاعدة البيانات
sleep 5

# تشغيل الهجرة التلقائية للجداول الجديدة فقط بدون مسح البيانات القديمة
php artisan migrate --force

# ربط مجلد التخزين للتأكد من قراءة الملفات المرفوعة
php artisan storage:link

# تشغيل خادم الويب والـ PHP
service nginx start && php-fpm
