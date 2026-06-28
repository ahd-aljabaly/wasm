<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تأكيد استلام الطلب</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f6f9; color: #333; margin: 0; padding: 20px; direction: rtl; }
        .container { max-width: 600px; margin: 0 auto; background: #ffffff; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .header { text-align: center; border-bottom: 2px solid #eef2f5; padding-bottom: 20px; margin-bottom: 20px; }
        .header h2 { color: #2d3748; margin: 0; }
        .content { line-height: 1.8; font-size: 16px; color: #4a5568; }
        .box { background: #f8fafc; padding: 15px; border-radius: 8px; border-right: 4px solid #3182ce; margin: 20px 0; }
        .footer { text-align: center; margin-top: 30px; font-size: 14px; color: #a0aec0; border-top: 1px solid #eef2f5; padding-top: 15px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>مرحباً {{ $submission->name }} 👋</h2>
        </div>
        <div class="content">
            <p>شكراً لتواصلك معنا! يسعدنا إبلاغك بأنه تم استلام رسالتك بنجاح.</p>
            <p>يقوم فريقنا حالياً بجمالية ومراجعة طلبك وسيتم التواصل معك في أقرب وقت ممكن عبر هذا البريد الإلكتروني أو الهاتف.</p>
            
            <div class="box">
                <strong>تفاصيل الطلب:</strong><br>
                • <strong>الخدمة المطلوبة:</strong> {{ $submission->service?->title ?? 'عام' }}<br>
                • <strong>رقم الهاتف:</strong> {{ $submission->phone }}<br>
                @if($submission->message)
                • <strong>تفاصيل الرسالة:</strong> {{ $submission->message }}
                @endif
            </div>

            
            <p>دمت بخير،<br>فريق العمل</p>
        </div>
        <div class="footer">
            هذه الرسالة تم إرسالها تلقائياً، يرجى عدم الرد المباشر عليها.
        </div>
    </div>
</body>
</html>
