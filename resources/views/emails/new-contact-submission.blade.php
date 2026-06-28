<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; background: #f6f3f2; padding: 24px; direction: rtl; }
        .box { background: #ffffff; border-radius: 12px; padding: 32px; max-width: 520px; margin: 0 auto; }
        h2 { color: #00184c; margin-bottom: 16px; }
        p { color: #1b1c1c; line-height: 1.7; margin: 8px 0; }
        .label { font-weight: bold; color: #795901; }
        .btn { display: inline-block; background: #00184c; color: #ffffff; text-decoration: none; padding: 12px 24px; border-radius: 8px; margin-top: 16px; }
    </style>
</head>
<body>
    <div class="box">
        <h2>طلب تواصل جديد</h2>
        <p>وصل طلب استشارة جديد عبر الموقع:</p>

        <p><span class="label">الاسم:</span> {{ $submission->name }}</p>

        @if($submission->company)
        <p><span class="label">الشركة:</span> {{ $submission->company }}</p>
        @endif

        <p><span class="label">البريد الإلكتروني:</span> {{ $submission->email }}</p>
        <p><span class="label">الهاتف:</span> {{ $submission->phone }}</p>

        @if($submission->service)
        <p><span class="label">الخدمة المطلوبة:</span> {{ $submission->service->title }}</p>
        @endif

        @if($submission->message)
        <p><span class="label">تفاصيل المشروع:</span><br>{{ $submission->message }}</p>
        @endif

        <a class="btn" href="{{ config('app.url') }}/admin/contact-submissions/{{ $submission->id }}">عرض الطلب بلوحة التحكم</a>
    </div>
</body>
</html>
