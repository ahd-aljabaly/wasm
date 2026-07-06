# دليل نشر موقع وسم ميديا على الإنترنت

دليل عملي لنشر الموقع (Laravel 13 + Filament 5) على أي استضافة. اتبع القسم المناسب لنوع استضافتك.

## متطلبات الخادم

- PHP **8.3** أو أحدث + الإضافات: `mbstring`, `xml`, `curl`, `gd`, `bcmath`, `ctype`, `fileinfo`, `openssl`, `pdo`, `tokenizer`، و`pdo_mysql` (لـ MySQL) أو `pdo_sqlite` (لـ SQLite)
- Composer 2
- Node.js 20+ (لبناء الأصول — أو ابنِها على جهازك وارفع مجلد `public/build`)
- شهادة SSL (HTTPS)

## الخطوات الأساسية (تنطبق على كل الاستضافات)

```bash
# 1) إحضار الكود
git clone https://github.com/ahd-aljabaly/wasm.git
cd wasm

# 2) اعتماديات PHP (وضع الإنتاج)
composer install --no-dev --optimize-autoloader

# 3) بناء الأصول (CSS/JS) — خطوة إلزامية
npm install
npm run build

# 4) ملف البيئة
cp .env.production.example .env
php artisan key:generate
# ثم عبّئ في .env: APP_URL، بيانات قاعدة البيانات، وبيانات SMTP

# 5) قاعدة البيانات + البيانات الأولية
php artisan migrate --force --seed

# 6) ربط مجلد التخزين (لظهور الشعار والصور المرفوعة)
php artisan storage:link

# 7) تحسين الأداء (كاش الإعدادات والراوتس والـ views)
php artisan optimize

# 8) صلاحيات الكتابة
chmod -R 775 storage bootstrap/cache
```

ثم وجّه جذر الموقع (Document Root) إلى مجلد **`public/`** فقط، وفعّل HTTPS.

## ملاحظات حسب نوع الاستضافة

### استضافة مشتركة (cPanel)
- أنشئ قاعدة بيانات MySQL من cPanel واستخدم بياناتها في `.env`.
- إن لم تستطع تغيير Document Root إلى `public`: انقل محتويات `public/` إلى `public_html`، وعدّل المسارات في `public_html/index.php` لتشير إلى مجلد المشروع.
- استخدم "Terminal" في cPanel لتنفيذ أوامر artisan، أو نفّذها عبر SSH.
- إن لم يتوفر Node على الخادم: نفّذ `npm run build` على جهازك وارفع مجلد `public/build` الناتج.

### خادم خاص VPS (Nginx)
- وجّه `root` في إعداد Nginx إلى `/path/to/wasm/public`.
- فعّل PHP-FPM 8.3، واحصل على شهادة SSL مجانية عبر Let's Encrypt (certbot).
- أعد تشغيل الطوابير إن استخدمتها: `php artisan queue:work` كخدمة supervisor.

### منصّات جاهزة (Railway / Render / Cloudways)
- اربط مستودع GitHub، اختر PHP، واضبط متغيرات البيئة من لوحة المنصّة.
- أمر البناء: `composer install --no-dev && npm install && npm run build`.
- أمر ما بعد النشر: `php artisan migrate --force --seed && php artisan storage:link && php artisan optimize`.

## قائمة تحقق أمنية قبل الإطلاق

- [ ] `APP_ENV=production` و `APP_DEBUG=false`
- [ ] `APP_KEY` مولّد (`php artisan key:generate`)
- [ ] `APP_URL` يطابق نطاقك مع https (يُستخدم في الـ og:image وsitemap)
- [ ] **تغيير كلمة مرور المدير** الافتراضية `admin123` من لوحة التحكم فوراً
- [ ] ضبط بيانات SMTP وتجربة إرسال طلب تواصل
- [ ] تعيين `notification_email` من لوحة التحكم (إعدادات) لبريدك الحقيقي
- [ ] رفع الشعار الحقيقي من لوحة التحكم (إعدادات → logo)
- [ ] تنفيذ `php artisan storage:link`
- [ ] تعديل `Sitemap:` في `public/robots.txt` ليشير لدومينك الحقيقي
- [ ] التحقق من ظهور صورة المعاينة عند مشاركة الرابط (Open Graph) عبر: https://developers.facebook.com/tools/debug/
- [ ] التحقق من Sitemap: `https://your-domain.com/sitemap.xml`


## الدخول للوحة التحكم

`https://your-domain.com/admin` — الحساب الافتراضي: `admin@wasmmedia.com` / `admin123` (غيّره فوراً).

## عند تحديث الموقع لاحقاً

```bash
git pull
composer install --no-dev --optimize-autoloader
npm install && npm run build
php artisan migrate --force
php artisan optimize:clear && php artisan optimize
```
