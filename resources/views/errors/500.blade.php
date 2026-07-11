<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - خطأ في الخادم | وسم ميديا</title>

    @php
        $errorLogoValue = \App\Models\Setting::get('logo');
        $errorLogoUrl = !empty($errorLogoValue)
            ? (str_starts_with($errorLogoValue, 'http') || str_starts_with($errorLogoValue, '/')
                ? $errorLogoValue
                : asset('storage/' . $errorLogoValue))
            : null;
    @endphp
    @if ($errorLogoUrl)
        <link rel="icon" href="{{ $errorLogoUrl }}">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Cairo', system-ui, sans-serif;
        }

        body {
            background: #FDFDFB;
            color: #172E66;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            text-align: center;
            padding: 20px;
        }

        .error-card {
            max-width: 520px;
            background: #ffffff;
            border: 1px solid #eef0f4;
            padding: 48px 40px;
            border-radius: 24px;
            box-shadow: 0 30px 60px -15px rgba(23, 46, 102, 0.10);
        }

        .error-code {
            font-size: 96px;
            font-weight: 900;
            background: linear-gradient(135deg, #EAD08B, #C5A24A 50%, #9A7B31);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            line-height: 1;
            margin-bottom: 16px;
        }

        h1 {
            font-size: 24px;
            font-weight: 800;
            margin-bottom: 12px;
        }

        p {
            color: #5b6478;
            margin-bottom: 32px;
            font-size: 15px;
            line-height: 1.8;
        }

        .btn {
            display: inline-block;
            background: #172E66;
            color: #fff;
            text-decoration: none;
            padding: 13px 32px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 14px;
            transition: background 0.2s, transform 0.2s;
        }

        .btn:hover {
            background: #0B1633;
            transform: translateY(-2px);
        }
    </style>
</head>

<body>
    <div class="error-card">
        <div class="error-code">500</div>
        <h1>حدث خطأ غير متوقع</h1>
        <p>نعتذر عن هذا الخلل، نحن نعمل على إصلاحه حالياً. يرجى المحاولة مرة أخرى لاحقاً.</p>
        <a href="{{ url('/') }}" class="btn">العودة للرئيسية</a>
    </div>
</body>

</html>
