#!/bin/sh

# الانتظار لثوانٍ بسيطة للتأكد من استقرار قاعدة البيانات
sleep 5

# تشغيل الهجرة العادية فقط (تضيف الجداول الجديدة دون مسح البيانات الحالية)
php artisan migrate --force

# ربط مجلد التخزين
php artisan storage:link

# تشغيل خادم الويب
service nginx start && php-fpm
