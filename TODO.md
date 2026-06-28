- [x] تعديل resources/views/index.blade.php لاستخدام بيانات DB (services, stats, projects, processSteps, settings)
- [x] التأكد من أسماء الحقول المطلوبة (title/description/value/label/slug/category/image)
- [x] ربط Portfolio بتصنيف من service slug
- [x] تشغيل/فحص الصفحة بدون أخطاء Blade
- [x] تعديل portfolio grid layout لاستعادة الترتيب عند استخدام بيانات DB

## إكمال نهائي (جاهزية للرفع)
- [x] مواءمة مفاتيح الإعدادات: logo / video / copyright بين الـ Seeder والواجهة
- [x] حماية الشعار والفيديو من القيم الفارغة + تصحيح مسار storage + بديل أنيق عند عدم الرفع
- [x] ربط hero_title من الإعدادات بالواجهة
- [x] إضافة mail.admin_address في config/mail.php و .env.example
- [x] حذف موديل ContactRequest غير المستخدم (كود ميت)
- [x] تصحيح خطأ شرط رفع الفيديو في SettingForm ($get('get') → $get('type'))
- [x] إضافة StatsOverview widget للوحة التحكم
- [x] إضافة اختبارات Feature للصفحة الرئيسية ونموذج التواصل + تفعيل RefreshDatabase
- [x] كتابة README كامل بخطوات التشغيل والنشر
