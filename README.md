# Wasm Media — موقع وكالة وسم ميديا الإبداعية

موقع تعريفي (Landing Page) لوكالة **وسم ميديا** مبني على **Laravel 13 + Filament 5**، مع لوحة تحكم كاملة لإدارة المحتوى (الخدمات، المشاريع، الإحصائيات، خطوات العمل، الإعدادات، وطلبات التواصل) بدون لمس الكود.

## المتطلبات

- PHP **8.3** أو أحدث (مع إضافات: `mbstring`, `xml`, `curl`, `sqlite3` أو `pdo_mysql`)
- Composer 2
- Node.js 20+ و npm

## التشغيل محلياً (خطوة بخطوة)

```bash
# 1) تثبيت اعتماديات PHP و JavaScript
composer install
npm install

# 2) تجهيز ملف البيئة ومفتاح التطبيق
cp .env.example .env
php artisan key:generate

# 3) قاعدة البيانات (الافتراضي SQLite)
#    أنشئ ملف قاعدة البيانات إن لم يكن موجوداً:
touch database/database.sqlite
php artisan migrate --seed

# 4) ربط مجلد التخزين لعرض الصور والفيديو المرفوعة من لوحة التحكم
php artisan storage:link

# 5) تشغيل الأصول (Vite) والخادم
npm run dev
php artisan serve
```

الموقع: `http://localhost:8000` — ولوحة التحكم: `http://localhost:8000/admin`

## الدخول للوحة التحكم

يُنشئ السيدر حساب مدير افتراضياً:

- البريد: `admin@wasmmedia.com`
- كلمة المرور: `admin123`

> ⚠️ غيّر كلمة المرور فوراً بعد أول دخول في بيئة الإنتاج.

## إدارة المحتوى من لوحة التحكم

| القسم | الوصف |
|------|-------|
| الخدمات (Services) | بطاقات الخدمات في الصفحة الرئيسية |
| المشاريع (Projects) | معرض الأعمال، مرتبط بالخدمات وبصور غلاف |
| الإحصائيات (Stats) | الأرقام المعروضة في الصفحة |
| خطوات العمل (Process Steps) | منهجية العمل |
| الإعدادات (Settings) | الشعار، الفيديو، نصوص الهيرو، روابط التواصل والسوشال |
| طلبات التواصل (Contact Submissions) | الطلبات الواردة من نموذج "تواصل معنا" مع متابعة حالتها |

### الشعار والفيديو

ارفع الشعار من **الإعدادات** عبر المفتاح `logo` (نوع: صورة)، والفيديو عبر المفتاح `video` (نوع: فيديو). إن لم تُرفع، يعرض الموقع اسم الوكالة كبديل أنيق تلقائياً. تأكد من تنفيذ `php artisan storage:link` لتظهر الملفات المرفوعة.

## البريد الإلكتروني

عند إرسال نموذج التواصل، يُرسل الموقع إشعاراً للإدارة وتأكيداً للعميل. اضبط في `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=...
MAIL_PORT=...
MAIL_USERNAME=...
MAIL_PASSWORD=...
MAIL_FROM_ADDRESS="hello@wasmmedia.com"
MAIL_ADMIN_ADDRESS="hello@wasmmedia.com"   # عنوان استقبال إشعارات الطلبات
```

أثناء التطوير يكفي `MAIL_MAILER=log` (تُكتب الرسائل في `storage/logs/laravel.log`).

## الاختبارات

```bash
php artisan test
```

تشمل اختبارات: تحميل الصفحة الرئيسية، حفظ طلب تواصل صحيح، ورفض الطلبات غير الصحيحة.

## النشر على الإنتاج (ملخص)

```bash
composer install --no-dev --optimize-autoloader
npm install && npm run build
php artisan migrate --force
php artisan storage:link
php artisan config:cache && php artisan route:cache && php artisan view:cache
```

اضبط في `.env`: `APP_ENV=production` و `APP_DEBUG=false` و `APP_URL=https://yourdomain.com`، ووجّه الويب سيرفر إلى مجلد `public/`.

## البنية التقنية

- **Backend:** Laravel 13 (PHP 8.3)
- **Admin:** Filament 5
- **Frontend:** Blade + Tailwind CSS 4 (عبر Vite)
- **قاعدة البيانات:** SQLite افتراضياً (يمكن التحويل لـ MySQL بتغيير `DB_*` في `.env`)
