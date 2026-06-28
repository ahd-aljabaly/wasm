<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - الصفحة غير موجودة</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: system-ui, -apple-system, sans-serif; }
        body { background: #0b0f19; color: #f3f4f6; display: flex; align-items: center; justify-content: center; min-height: 100vh; text-align: center; padding: 20px; }
        .error-card { max-width: 500px; background: #111827; border: 1px solid #1f2937; padding: 40px; border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.5); }
        .error-code { font-size: 80px; font-weight: 900; background: linear-gradient(135deg, #6366f1, #a855f7); -webkit-background-clip: text; -webkit-text-fill-color: transparent; line-height: 1; margin-bottom: 20px; }
        h1 { font-size: 24px; margin-bottom: 12px; }
        p { color: #9ca3af; margin-bottom: 30px; font-size: 16px; line-height: 1.6; }
        .btn { display: inline-block; background: linear-gradient(135deg, #6366f1, #a855f7); color: #fff; text-decoration: none; padding: 12px 28px; border-radius: 8px; font-weight: 600; transition: transform 0.2s, opacity 0.2s; }
        .btn:hover { transform: translateY(-2px); opacity: 0.9; }
    </style>
</head>
<body>
    <div class="error-card">
        <div class="error-code">404</div>
        <h1>الصفحة غير موجودة</h1>
        <p>عذراً، الصفحة التي تبحث عنها غير موجودة أو تم نقلها إلى مكان آخر.</p>
        <a href="{{ url('/') }}" class="btn">العودة للرئيسية</a>
    </div>
</body>
</html>
