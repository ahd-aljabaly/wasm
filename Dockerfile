FROM php:8.4-fpm

# تثبيت إضافات النظام والـintl والـMySQL المطلوبة لـ Laravel و Filament وتثبيت الـ Node.js والـ NPM
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nginx \
    libicu-dev \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# تنظيف الكاش
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# تثبيت إضافات PHP المخصصة وتفعيل intl بالكامل
RUN docker-php-ext-configure intl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd intl

# جلب أحدث نسخة من الـ Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# تحديد مجلد العمل داخل السيرفر
WORKDIR /var/www

# نسخ ملفات المشروع بالكامل
COPY . /var/www

# نسخ ملف إعدادات nginx لتوجيه المسار لـ public
COPY docker/nginx.conf /etc/nginx/sites-available/default

# تثبيت حزم الـ Composer مع تجاهل فحص المنصة
RUN composer install --no-interaction --optimize-autoloader --no-dev --ignore-platform-reqs

# تثبيت حزم الـ NPM وبناء ملفات الـ Vite (هذا هو السطر السحري الجديد)
RUN npm install && npm run build

# ضبط الصلاحيات للمجلدات المهمة لـ Laravel
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# إعطاء صلاحيات التشغيل لسكربت الإقلاع
RUN chmod +x /var/www/entrypoint.sh

# تجهيز خادم الويب والمنافذ
EXPOSE 80

# تشغيل السكربت كأمر إقلاع أساسي وجذري
CMD ["/var/www/entrypoint.sh"]
