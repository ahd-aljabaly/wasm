#!/bin/sh

# الانتظار لثوانٍ بسيطة للتأكد من استقرار شبكة قاعدة البيانات
sleep 5

# تشغيل الهجرة وتغذية البيانات تلقائياً داخل الحاوية المستقرة
php artisan migrate --force
php artisan db:seed --force

# تشغيل خادم الويب والـ PHP-FPM للبدء في استقبال الزوار
service nginx start && php-fpm
