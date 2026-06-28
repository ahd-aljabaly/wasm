<!DOCTYPE html>
<html dir="rtl" lang="ar" class="scroll-smooth">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Wasm Media | وسم ميديا - وكالة إبداعية متكاملة</title>
    <meta name="description" content="وكالة واصم ميديا الإبداعية: هوية بصرية، تسويق رقمي، صناعة محتوى، وحلول التغليف والطباعة الفاخرة.">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:title" content="Wasm Media | واصم ميديا">
    <meta property="og:description" content="وكالة إبداعية متخصصة في بناء العلامات التجارية والحلول التسويقية المتكاملة.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">

    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate icon" href="{{ asset('favicon.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

    <style>
        :root {
            --color-primary: #172E66;
            --color-secondary: #C5A24A;
            --color-dark: #0B1633;
        }
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #fdfdfc;
        }
        .text-gradient-gold {
            background: linear-gradient(135deg, #EAD08B 0%, #C5A24A 50%, #9A7B31 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .bg-gradient-primary {
            background: linear-gradient(135deg, #1D397C 0%, #172E66 50%, #0B1633 100%);
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 30px 60px -15px rgba(23, 46, 102, 0.08);
        }
        .glass-video-card {
            background: rgba(23, 46, 102, 0.03);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(23, 46, 102, 0.08);
        }
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.85s cubic-bezier(0.16, 1, 0.3, 1), transform 0.85s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }
        .lines-layer {
            background-image: linear-gradient(rgba(23, 46, 102, 0.015) 1px, transparent 1px),
                              linear-gradient(90deg, rgba(23, 46, 102, 0.015) 1px, transparent 1px);
            background-size: 60px 60px;
        }
        @keyframes pulse-slow {
            0%, 100% { transform: scale(1) translate(0px, 0px); opacity: 0.5; }
            50% { transform: scale(1.12) translate(20px, -20px); opacity: 0.75; }
        }
        .animate-pulse-slow { animation: pulse-slow 10s ease-in-out infinite; }
        .animate-pulse-slow-reverse { animation: pulse-slow 14s ease-in-out infinite reverse; }

        .filter-btn.active {
            background-color: var(--color-primary) !important;
            color: #ffffff !important;
            border-color: var(--color-primary) !important;
            box-shadow: 0 8px 20px rgba(23, 46, 102, 0.15);
        }
        input:focus, select:focus, textarea:focus {
            outline: none !important;
            border-color: var(--color-secondary) !important;
            box-shadow: 0 0 0 4px rgba(197, 162, 74, 0.12) !important;
        }
        .field-error { border-color: #ba1a1a !important; }
        .field-error-msg { display: none; color: #ba1a1a; font-size: 11px; font-weight: 700; margin-top: 4px; }
        .field-error-msg.show { display: block; }
    </style>
</head>
<body class="text-slate-800 antialiased overflow-x-hidden">

@php
    // روابط آمنة للشعار والفيديو: تُبنى من storage إذا رُفعت من لوحة التحكم، وإلا تبقى null
    $logoVal = $settings['logo'] ?? null;
    $logoUrl = !empty($logoVal)
        ? ((str_starts_with($logoVal, 'http') || str_starts_with($logoVal, '/')) ? $logoVal : asset('storage/' . $logoVal))
        : null;
    $videoVal = $settings['video'] ?? null;
    $videoUrl = !empty($videoVal)
        ? ((str_starts_with($videoVal, 'http') || str_starts_with($videoVal, '/')) ? $videoVal : asset('storage/' . $videoVal))
        : null;
    $siteName = $settings['site_name'] ?? 'Wasm Media';
@endphp

<!-- القائمة العلوية Navbar -->
<header class="bg-white/90 backdrop-blur-md fixed w-full top-0 shadow-sm z-50 transition-all border-b border-slate-100">
    <div class="flex justify-between items-center w-full px-6 max-w-[1240px] mx-auto h-20">
        <!-- الـ Logo بدلاً من الكلمة النصية القديمة وبأبعاد متناسقة مقتبسة من الشعار -->
        <a href="#home" class="flex items-center gap-2 h-full py-3">
            @if($logoUrl)
                <img src="{{ $logoUrl }}" alt="{{ $siteName }}" class="h-full w-auto object-contain max-h-[52px]">
            @else
                <span class="text-xl md:text-2xl font-black text-[#172E66] tracking-tight">{{ $siteName }}</span>
            @endif
        </a>
        {{-- {{ $settings['instagram_url'] }} --}}
        <nav class="hidden md:flex gap-8 items-center font-semibold text-sm" id="desktopNav">
            <a class="nav-link text-[#172E66] hover:text-[#C5A24A] font-bold border-b-2 border-[#C5A24A] pb-1 transition-all" href="#home" data-section="home">الرئيسية</a>
            <a class="nav-link text-[#172E66] hover:text-[#C5A24A] pb-1 border-b-2 border-transparent transition-all" href="#services" data-section="services">خدماتنا</a>
            <a class="nav-link text-[#172E66] hover:text-[#C5A24A] pb-1 border-b-2 border-transparent transition-all" href="#portfolio" data-section="portfolio">أعمالنا</a>
            <a class="nav-link text-[#172E66] hover:text-[#C5A24A] pb-1 border-b-2 border-transparent transition-all" href="#process" data-section="process">منهجيتنا</a>
            {{-- <a class="nav-link text-[#172E66] hover:text-[#C5A24A] pb-1 border-b-2 border-transparent transition-all" href="#contact" data-section="contact">اتصل بنا</a> --}}
        </nav>
        <div class="flex items-center gap-3">
            <a href="#contact" class="hidden sm:inline-flex bg-[#172E66] text-white text-xs md:text-sm font-bold px-6 py-3 rounded-xl hover:bg-[#0B1633] transition-all shadow-md shadow-blue-900/10">
اتصل بنا            </a>
            <button id="menuToggle" class="md:hidden w-10 h-10 flex items-center justify-center rounded-lg text-[#172E66]" aria-label="فتح القائمة">
                <span class="material-symbols-outlined text-2xl" id="menuIcon">menu</span>
            </button>
        </div>
    </div>
    <div id="mobileMenu" class="hidden md:hidden bg-white border-t border-slate-100 px-6 py-4">
        <nav class="flex flex-col gap-4 font-semibold text-sm">
            <a class="text-[#C5A24A] font-bold" href="#home">الرئيسية</a>
            <a class="text-[#172E66]" href="#services">خدماتنا</a>
            <a class="text-[#172E66]" href="#portfolio">أعمالنا</a>
            <a class="text-[#172E66]" href="#process">منهجيتنا</a>
            {{-- <a class="text-[#172E66]" href="#contact">اتصل بنا</a> --}}
            <a href="#contact" class="bg-[#172E66] text-white text-sm font-bold px-6 py-3 rounded-xl text-center mt-2"> اتصل بنا </a>
        </nav>
    </div>
</header>

<!-- قسم الهيرو (Hero Section) المطور بالكامل بالفيديو والطبقات اللونية الفاخرة -->
<section id="home" class="relative min-h-screen flex items-center justify-center overflow-hidden pt-28 pb-16 bg-[#FDFDFB]">
    <div class="absolute inset-0 w-full h-full opacity-100 lines-layer"></div>

    <!-- هالات لملء بياض الخلفية مستوحاة من ألوان واصم ميديا المعتمدة -->
    <div class="absolute top-10 left-5 w-[450px] md:w-[650px] h-[450px] md:h-[650px] bg-[#172E66]/5 rounded-full blur-[120px] animate-pulse-slow -z-10"></div>
    <div class="absolute bottom-5 right-5 w-[400px] md:w-[600px] h-[400px] md:h-[600px] bg-[#C5A24A]/8 rounded-full blur-[110px] animate-pulse-slow-reverse -z-10"></div>

    <div class="max-w-[1240px] mx-auto px-6 relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center w-full">

        <!-- النصوص والطلب (الجانب الأيمن) -->
        <div class="lg:col-span-6 text-right flex flex-col justify-center items-start">
            <div class="reveal inline-flex items-center gap-2 bg-[#172E66]/5 border border-[#172E66]/10 text-[#172E66] px-4 py-2 rounded-full text-xs font-bold mb-6">
                <span class="w-2 h-2 rounded-full bg-[#C5A24A] animate-ping"></span>
                <span>نصنع الأثر ونبني الهوية</span>
            </div>

            <h1 class="reveal text-4xl md:text-5xl lg:text-6xl text-[#172E66] mb-6 leading-[1.25] font-black tracking-tight">
                @if(!empty($settings['hero_title']))
                    {!! $settings['hero_title'] !!}
                @else
                    نصمم هوية <span class="text-gradient-gold font-black">تترك أثراً</span> ونبني حضوراً يُلاحَظ
                @endif
            </h1>

            <p class="reveal text-sm md:text-base text-slate-600 mb-8 max-w-xl font-medium leading-relaxed">
               {{ $settings['hero_subtitle'] ?? '' }}
            </p>

            <div class="reveal flex flex-col sm:flex-row gap-4 w-full sm:w-auto" style="transition-delay: 200ms;">
                <a href="#contact" class="bg-[#172E66] text-white text-sm font-bold px-8 py-4 rounded-xl hover:bg-[#0B1633] transition-all shadow-lg shadow-blue-900/10 text-center">
                    اطلب استشارة مجانية
                </a>
                <a href="#portfolio" class="bg-white border border-slate-200 text-[#172E66] text-sm font-bold px-8 py-4 rounded-xl hover:bg-slate-50 transition-all text-center shadow-sm">
                    استكشف أعمالنا
                </a>
            </div>
        </div>

        <!-- عرض الفيديو السينمائي الفاخر (الجانب الأيسر) بتنسيق هندسي فخم وعميق -->
    <div class="lg:col-span-6 w-full reveal" style="transition-delay: 150ms;">
    <div class="glass-video-card p-3 md:p-4 rounded-3xl relative shadow-2xl border border-slate-200/40 max-w-xl mx-auto lg:mr-auto lg:ml-0 group bg-white/5">
        <div class="relative aspect-[16/9] w-full rounded-2xl overflow-hidden shadow-inner bg-[#0B1633]">

            @if($videoUrl)
            <video class="w-full h-full object-cover opacity-100 scale-100 group-hover:scale-105 transition-transform duration-1000"
                   autoplay
                   loop
                   muted
                   playsinline
                   oncanplay="this.play()"
                   onloadedmetadata="this.muted = true">
                <source src="{{ $videoUrl }}" type="video/mp4">
            </video>
            @else
            {{-- لا يوجد فيديو مرفوع: خلفية متدرّجة فاخرة بشعار الوكالة كبديل --}}
            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-[#0B1633] via-[#172E66] to-[#0B1633]">
                @if($logoUrl)
                    <img src="{{ $logoUrl }}" alt="{{ $siteName }}" class="h-12 w-auto brightness-0 invert opacity-90">
                @else
                    <span class="text-2xl font-black text-white/90 tracking-tight">{{ $siteName }}</span>
                @endif
            </div>
            @endif

            <div class="absolute inset-0 bg-gradient-to-t from-[#0B1633]/40 via-transparent to-transparent pointer-events-none"></div>

            <div class="absolute bottom-4 right-4 bg-white/10 backdrop-blur-md px-3 py-1.5 rounded-lg border border-white/20 z-20">
                @if($logoUrl)
                    <img src="{{ $logoUrl }}" alt="{{ $siteName }}" class="h-5 w-auto brightness-0 invert">
                @else
                    <span class="text-xs font-black text-white">{{ $siteName }}</span>
                @endif
            </div>
            
        </div>
    </div>
</div>

    </div>
</section>

<!-- مودال عرض الفيديو بكامل الشاشة عند الضغط (Video Modal Player) -->
<div id="videoModal" class="fixed inset-0 bg-black/90 z-[100] hidden opacity-0 transition-opacity duration-300 flex items-center justify-center p-4">
    <button onclick="closeVideoModal()" class="absolute top-6 left-6 text-white hover:text-[#C5A24A] bg-white/10 p-3 rounded-full transition-colors">
        <span class="material-symbols-outlined text-2xl">close</span>
    </button>
    <div class="w-full max-w-4xl aspect-[16/9] rounded-2xl overflow-hidden shadow-2xl border border-white/10 bg-black">
        <video id="modalVideo" class="w-full h-full object-contain" controls>
            <source src="https://assets.mixkit.co/videos/preview/mixkit-digital-animation-of-a-logo-reveal-41662-large.mp4" type="video/mp4">
        </video>
    </div>
</div>

<!-- قسم الإحصائيات (Stats Section) -->
<section class="py-16 bg-white border-y border-slate-100 relative z-20">
    <div class="max-w-[1240px] mx-auto px-6">
        @if(!empty($stats) && $stats->count())
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 md:gap-4 text-center">
                @foreach($stats as $stat)
                    <div class="reveal p-2 border-l border-slate-100 last:border-0" style="transition-delay: {{ $loop->iteration * 100 - 100 }}ms;">
                        @if(!empty($stat->icon))
                            <span class="material-symbols-outlined text-[#C5A24A] text-3xl mb-2" style="font-variation-settings: 'FILL' 1;">{{ $stat->icon }}</span>
                        @endif
                        <h3 class="text-2xl md:text-3xl text-[#172E66] mb-1 font-black">{{ $stat->value }}</h3>
                        <p class="text-xs md:text-sm text-slate-500 font-bold">{{ $stat->label }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 md:gap-4 text-center">
                <div class="reveal p-2 border-l border-slate-100 last:border-0">
                    <span class="material-symbols-outlined text-[#C5A24A] text-3xl mb-2" style="font-variation-settings: 'FILL' 1;">groups</span>
                    <h3 class="text-2xl md:text-3xl text-[#172E66] mb-1 font-black">120+</h3>
                    <p class="text-xs md:text-sm text-slate-500 font-bold">عميل سعيد</p>
                </div>
            </div>
        @endif
    </div>
</section>


<!-- قسم الخدمات (Services Section) -->
<section class="py-20 md:py-24 bg-[#FDFDFB]" id="services">
    <div class="max-w-[1240px] mx-auto px-6">
        <div class="mb-14 reveal">
            <div class="inline-flex items-center gap-2 bg-[#172E66]/5 text-[#172E66] px-4 py-1.5 rounded-full text-xs font-bold mb-4">
                <span class="material-symbols-outlined text-sm">grid_view</span>
                <span>تخصصاتنا ومجالاتنا الإبداعية</span>
            </div>
            <h2 class="text-2xl md:text-4xl text-[#172E66] font-black max-w-xl leading-tight">نحن لا نبيع خدمات، نحن نصنع حلول نمو متكاملة ومترابطة</h2>
        </div>

        @if(!empty($services) && $services->count())
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                @foreach($services as $service)
                    <div class="glass-card p-6 md:p-8 rounded-2xl flex flex-col justify-between hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden group border-r-4 border-r-[#172E66]">
                        <div>
                            <div class="flex justify-between items-start mb-6">
                                <div class="w-12 h-12 bg-[#172E66] text-white rounded-xl flex items-center justify-center shadow-md shadow-blue-900/10">
                                    @if(!empty($service->icon))
                                        <span class="material-symbols-outlined text-xl font-bold">{{ $service->icon }}</span>
                                    @else
                                        <span class="material-symbols-outlined text-xl font-bold">brush</span>
                                    @endif
                                </div>
                            </div>
                            <h3 class="text-lg md:text-xl text-[#172E66] mb-3 font-black">{{ $service->title }}</h3>
                            @if(!empty($service->description))
                                <p class="text-slate-600 text-xs md:text-sm leading-relaxed">{{ $service->description }}</p>
                            @endif
                        </div>
                        <div class="mt-6 flex items-center gap-2 text-xs font-bold text-[#172E66] group-hover:text-[#C5A24A] transition-colors cursor-pointer"
                             onclick="document.getElementById('contact').scrollIntoView({behavior: 'smooth'})">
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="glass-card p-6 md:p-8 rounded-2xl flex flex-col justify-between hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden group border-r-4 border-r-[#172E66]">
                    <div>
                        <div class="flex justify-between items-start mb-6">
                            <div class="w-12 h-12 bg-[#172E66] text-white rounded-xl flex items-center justify-center shadow-md shadow-blue-900/10">
                                <span class="material-symbols-outlined text-xl font-bold">brush</span>
                            </div>
                        </div>
                        <h3 class="text-lg md:text-xl text-[#172E66] mb-3 font-black">الخدمات</h3>
                        <p class="text-slate-600 text-xs md:text-sm leading-relaxed">لا توجد بيانات لخدماتك حالياً.</p>
                    </div>
                </div>
            </div>
        @endif

    </div>
</section>

<!-- قسم أعمالنا (Portfolio Section) -->
<!-- قسم أعمالنا (Portfolio Section) -->
<section class="py-20 md:py-24 bg-white border-t border-surface-variant/40" id="portfolio">
    <div class="max-w-[1240px] mx-auto px-6">
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end mb-14 reveal gap-6">
            <div>
                <h2 class="text-2xl md:text-3xl text-primary mb-2 font-extrabold">معرض أعمالنا الاستراتيجية</h2>
                <p class="text-on-surface-variant text-xs md:text-sm">تصفح كيف ساعدنا شركاءنا على تحويل أهدافهم لقصص نجاح واقعية ومبهرة.</p>
            </div>

            <div class="flex flex-wrap gap-1 bg-white/70 p-1 rounded-xl border border-surface-variant shadow-sm backdrop-blur-sm">
                <button class="filter-btn active text-xs font-bold px-4 py-2 rounded-lg transition-all" onclick="filterPortfolio('all', this)">الكل</button>
                <button class="filter-btn text-xs font-bold px-4 py-2 rounded-lg text-on-surface-variant hover:text-primary transition-all" onclick="filterPortfolio('branding', this)">الهويات البصرية</button>
                <button class="filter-btn text-xs font-bold px-4 py-2 rounded-lg text-on-surface-variant hover:text-primary transition-all" onclick="filterPortfolio('marketing', this)">التسويق والمحتوى</button>
                <button class="filter-btn text-xs font-bold px-4 py-2 rounded-lg text-on-surface-variant hover:text-primary transition-all" onclick="filterPortfolio('print', this)">التغليف والإنتاج</button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="portfolio-grid">
            @forelse($projects as $project)
                <a href="{{ route('projects.show', $project->slug) }}" class="portfolio-item {{ $project->service?->slug ?? 'all' }} block group relative overflow-hidden rounded-2xl bg-primary shadow-sm cursor-pointer transition-all duration-500 hover:shadow-xl hover:-translate-y-1.5">
                    <div class="aspect-[4/3] w-full relative grayscale group-hover:grayscale-0 transition-all duration-700 flex items-center justify-center" style="background-color: {{ $project->accent_color ?? '#172E66' }};">
                        @if($project->cover_image)
                            <img src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
                        @else
                            <div class="absolute -left-10 -top-10 w-48 h-48 rounded-full border-[16px] border-white/5"></div>
                            <div class="absolute left-16 bottom-6 w-24 h-24 rounded-full border-[10px] border-secondary/15"></div>
                        @endif
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-primary via-primary/20 to-transparent flex flex-col justify-end p-6">
                        <div class="flex gap-2 mb-2">
                            <span class="text-[9px] font-bold text-white bg-secondary px-2.5 py-1 rounded-full truncate max-w-full">{{ $project->category_label }}</span>
                        </div>
                        <!-- line-clamp-1 لمنع العنوان من النزول لسطر ثانٍ وتخريب التصميم -->
                        <h3 class="text-on-primary text-lg mb-1 font-bold line-clamp-1" title="{{ $project->title }}">{{ $project->title }}</h3>
                        <!-- line-clamp-2 لتثبيت الوصف على سطرين كحد أقصى -->
                        <p class="text-secondary-fixed text-xs opacity-90 line-clamp-2">{{ $project->short_description }}</p>
                    </div>
                </a>
            @empty
                <div class="portfolio-item branding group relative overflow-hidden rounded-2xl bg-primary shadow-sm cursor-pointer transition-all duration-500 hover:shadow-xl hover:-translate-y-1.5">
                    <div class="aspect-[4/3] w-full bg-[#1A2F4C] relative grayscale group-hover:grayscale-0 transition-all duration-700 flex items-center justify-center">
                        <div class="absolute -left-10 -top-10 w-48 h-48 rounded-full border-[16px] border-white/5"></div>
                        <div class="absolute left-16 bottom-6 w-24 h-24 rounded-full border-[10px] border-secondary/15"></div>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-primary via-primary/20 to-transparent flex flex-col justify-end p-6">
                        <div class="flex gap-2 mb-2">
                            <span class="text-[9px] font-bold text-white bg-secondary px-2.5 py-1 rounded-full">هوية بصرية كاملة</span>
                        </div>
                        <h3 class="text-on-primary text-lg mb-1 font-bold line-clamp-1">مجموعة مطاعم ومطابخ الزيتون الفاخرة</h3>
                        <p class="text-secondary-fixed text-xs opacity-90 line-clamp-2">هندسة الهوية البصرية ودليل تطبيقات الفروع الشامل.</p>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="flex justify-center mt-12 reveal">
            <a href="{{ route('projects.index') }}" class="inline-flex items-center gap-2 bg-[#172E66] text-white text-xs md:text-sm font-bold px-8 py-4 rounded-xl hover:bg-[#0B1633] transition-all shadow-lg shadow-blue-900/10">
                <span>عرض جميع الأعمال</span>
                <span class="material-symbols-outlined text-sm">arrow_back</span>
            </a>
        </div>
    </div>
</section>

<!-- قسم المنهجية (Process Section) -->
<section class="py-20 md:py-24 bg-[#FDFDFB]" id="process">
    <div class="max-w-[1240px] mx-auto px-6">
        <div class="text-center mb-16 reveal">
            <h2 class="text-2xl md:text-3xl text-[#172E66] mb-3 font-black">خطوات المنهجية المدروسة</h2>
            <p class="text-slate-500 max-w-2xl mx-auto text-xs md:text-sm">منظومة عمل مرنة وواضحة تضمن لك تدفقاً يسيراً للمعلومات وأفضل جودة للمخرجات النهائية بأقل مجهود منك.</p>
        </div>

        <div class="relative max-w-4xl mx-auto mt-12">
            <div class="hidden md:block absolute top-6 left-0 w-full h-[2px] bg-slate-200 -z-10"></div>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 relative z-10">
                @if(!empty($processSteps) && $processSteps->count())
                    @foreach($processSteps as $step)
                        @php
                            $n = $step->step_number ?? $loop->iteration;
                            $delay = $loop->iteration * 150 - 150;
                            $isLast = $loop->iteration === $processSteps->count();
                        @endphp
                        <div class="text-center reveal group" style="transition-delay: {{ $delay }}ms;">
                            @if($isLast)
                                <div class="w-12 h-12 bg-[#C5A24A] text-white rounded-full flex items-center justify-center mx-auto mb-4 font-bold shadow-md group-hover:scale-105 transition-transform">{{ $n }}</div>
                            @else
                                <div class="w-12 h-12 bg-white text-[#172E66] border-2 border-[#172E66] rounded-full flex items-center justify-center mx-auto mb-4 font-bold shadow-md group-hover:scale-105 transition-transform">{{ $n }}</div>
                            @endif
                            <h3 class="text-base text-[#172E66] mb-2 font-bold">{{ $step->title }}</h3>
                            @if(!empty($step->description))
                                <p class="text-slate-500 text-xs leading-relaxed px-2">{{ $step->description }}</p>
                            @endif
                        </div>
                    @endforeach
                @else
                    <div class="text-center reveal group">
                        <div class="w-12 h-12 bg-[#172E66] text-white rounded-full flex items-center justify-center mx-auto mb-4 font-bold shadow-md group-hover:scale-105 transition-transform">1</div>
                        <h3 class="text-base text-[#172E66] mb-2 font-bold">خطواتنا</h3>
                        <p class="text-slate-500 text-xs leading-relaxed px-2">لا توجد خطوات حالياً.</p>
                    </div>
                @endif
            </div>

        </div>
    </div>
</section>

<!-- قسم فورم التواصل المطور (Contact Section) -->
<section class="py-20 md:py-24 bg-surface-container-low relative overflow-hidden" id="contact">
    <div class="absolute top-1/2 left-0 w-96 h-96 bg-primary/4 rounded-full blur-3xl -z-10"></div>

    <div class="max-w-[1240px] mx-auto px-6 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">

            <!-- الجانب الأيمن: معلومات التواصل -->
            <div class="lg:col-span-5 reveal">
                <div class="inline-flex items-center gap-2 bg-secondary/10 text-secondary px-4 py-1.5 rounded-full text-xs font-bold mb-4">
                    <span class="material-symbols-outlined text-sm">hub</span>
                    <span>ابدأ رحلة النمو اليوم</span>
                </div>
                <h2 class="text-2xl md:text-4xl text-primary font-black mb-6 leading-[1.3]">دعنا نصنع لشركتك حضوراً لا يمكن تجاوزه</h2>
                <p class="text-on-surface-variant text-xs md:text-sm leading-relaxed mb-8 max-w-md">
                    سواء كنت تبحث عن تأسيس علامة تجارية جديدة أو إطلاق حملة تسويقية تضاعف مبيعاتك، فريقنا على أهبة الاستعداد لخدمتك.
                </p>

                <div class="space-y-4 max-w-sm">
                    <div class="flex items-center gap-4 p-4 rounded-xl bg-white/50 border border-white/40 backdrop-blur-sm">
                        <div class="w-10 h-10 bg-primary/10 text-primary rounded-lg flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-lg">mail</span>
                        </div>
                        <div>
                            <p class="text-[10px] text-on-surface-variant font-bold">راسلنا مباشرة</p>
                            <p class="text-sm font-extrabold text-primary">{{ $settings['contact_email'] ?? 'hello@wasmmedia.com' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 p-4 rounded-xl bg-white/50 border border-white/40 backdrop-blur-sm">
                        <div class="w-10 h-10 bg-primary/10 text-primary rounded-lg flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-lg">call</span>
                        </div>
                        <div>
                            <p class="text-[10px] text-on-surface-variant font-bold">اتصال أو واتساب</p>
                            <p class="text-sm font-extrabold text-primary" dir="ltr">{{ $settings['contact_phone'] ?? '+966 50 000 0000' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- الجانب الأيسر: الفورم المشطب هندسياً (Premium Ultra Clean Form) -->
            <div class="lg:col-span-7 reveal" style="transition-delay: 150ms;">
                <div class="glass-card p-6 md:p-10 rounded-2xl shadow-xl border border-white/60">
                    <div id="formWrap">
                        <h3 class="text-lg md:text-xl text-primary font-extrabold mb-1">طلب استشارة مجانية</h3>
                        <p class="text-[11px] text-on-surface-variant mb-6 font-medium">احصل على تحليل أولي لعلامتك التجارية خلال 24 ساعة فقط.</p>

                        <form id="contactForm" class="space-y-5" novalidate>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-[11px] font-bold text-primary mb-1.5">الاسم الكريم *</label>
                                    <input type="text" id="f-name" class="w-full bg-white/90 border border-primary/10 focus:border-primary focus:ring-0 rounded-xl px-4 py-3 text-xs md:text-sm transition-all placeholder-gray-400" placeholder="أدخل اسمك الكامل">
                                    <span class="field-error-msg" id="err-name">الرجاء إدخال الاسم الكامل (حرفين على الأقل)</span>
                                </div>
                                <div>
                                    <label class="block text-[11px] font-bold text-primary mb-1.5">اسم المنشأة / الشركة</label>
                                    <input type="text" id="f-company" class="w-full bg-white/90 border border-primary/10 focus:border-primary focus:ring-0 rounded-xl px-4 py-3 text-xs md:text-sm transition-all placeholder-gray-400" placeholder="شركتك أو مشروعك">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-[11px] font-bold text-primary mb-1.5">بريدك الإلكتروني *</label>
                                    <input type="email" id="f-email" class="w-full bg-white/90 border border-primary/10 focus:border-primary focus:ring-0 rounded-xl px-4 py-3 text-xs md:text-sm transition-all placeholder-gray-400" placeholder="name@company.com">
                                    <span class="field-error-msg" id="err-email">الرجاء إدخال بريد إلكتروني صحيح</span>
                                </div>
                                <div>
                                    <label class="block text-[11px] font-bold text-primary mb-1.5">رقم الجوال *</label>
                                    <input type="tel" id="f-phone" class="w-full bg-white/90 border border-primary/10 focus:border-primary focus:ring-0 rounded-xl px-4 py-3 text-xs md:text-sm transition-all placeholder-gray-400" placeholder="+966">
                                    <span class="field-error-msg" id="err-phone">الرجاء إدخال رقم جوال صحيح</span>
                                </div>
                            </div>

                            <div>
                                <label class="block text-[11px] font-bold text-primary mb-1.5">ما هو الحل الإبداعي الذي تبحث عنه؟ *</label>
                                <select id="f-service" class="w-full bg-white/90 border border-primary/10 focus:border-primary focus:ring-0 rounded-xl px-4 py-3 text-xs md:text-sm transition-all text-on-surface-variant">
                                    <option value="">اختر الخدمة المطلوبة</option>
                                    @foreach($services as $service)
                                        <option value="{{ $service->slug }}">{{ $service->title }}</option>
                                    @endforeach
                                    @if($services->isEmpty())
                                        <option value="branding">استراتيجيات وتصميم هوية بصرية كاملة</option>
                                        <option value="packaging">تخطيط وتصميم التغليف والطباعة الفاخرة</option>
                                        <option value="marketing">إدارة الحملات التسويقية وصناعة المحتوى</option>
                                        <option value="digital">حلول رقمية وتصميم مواقع مخصصة</option>
                                    @endif
                                </select>
                                <span class="field-error-msg" id="err-service">الرجاء اختيار نوع الخدمة</span>
                            </div>

                            <div>
                                <label class="block text-[11px] font-bold text-primary mb-1.5">تفاصيل إضافية حول مشروعك</label>
                                <textarea rows="3" id="f-message" class="w-full bg-white/90 border border-primary/10 focus:border-primary focus:ring-0 rounded-xl px-4 py-3 text-xs md:text-sm transition-all placeholder-gray-400 resize-none" placeholder="حدثنا باختصار عن أهدافك وميزانيتك المتوقعة..."></textarea>
                            </div>

                            <button type="submit" class="w-full bg-primary hover:bg-primary-container text-on-primary text-xs md:text-sm font-bold py-3.5 rounded-xl shadow-lg hover:shadow-xl transition-all flex items-center justify-center gap-2">
                                <span>إرسال الطلب وحجز الجلسة</span>
                                <span class="material-symbols-outlined text-sm">send</span>
                            </button>
                        </form>
                    </div>
                    <div class="form-success-box" id="formSuccess">
                        <div class="w-14 h-14 rounded-full bg-green-100 flex items-center justify-center mx-auto mb-4">
                            <span class="material-symbols-outlined text-green-700 text-2xl">check</span>
                        </div>
                        <h4 class="text-base font-extrabold text-primary mb-2">تم استلام طلبك بنجاح</h4>
                        <p class="text-xs text-on-surface-variant">سيتواصل معك مستشارنا الإبداعي خلال 24 ساعة</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- الفوتر (Footer) -->
<footer class="bg-[#0B1633] text-white pt-16 pb-8 border-t border-slate-800 relative z-20">
    <div class="max-w-[1240px] mx-auto px-6">
        <div class="flex flex-col md:flex-row justify-between items-center gap-6 pb-8 border-b border-slate-800">
            @if($logoUrl)
                <img src="{{ $logoUrl }}" alt="{{ $siteName }}" class="h-10 w-auto brightness-0 invert">
            @else
                <span class="text-2xl font-black text-white tracking-tight">{{ $siteName }}</span>
            @endif
            <p class="text-xs text-slate-400 max-w-sm text-center md:text-right">{{ $settings['footer_text'] ?? '' }}</p>
        </div>
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 pt-8">
    <p class="text-[11px] text-slate-500 font-medium">{{ $settings['copyright'] ?? 'جميع الحقوق محفوظة © وسم ميديا' }}</p>
    
    <div class="flex flex-col md:flex-row justify-between items-center gap-6 pt-8 border-t border-slate-800/40">
   
    
    <div class="flex flex-wrap gap-3 order-1 md:order-2 justify-center">
        @foreach($settings as $key => $url)
            {{-- فلترة الإعدادات لجلب الروابط المفعلة فقط والتي تنتهي بـ _url --}}
            @if(str_ends_with($key, '_url') && !empty($url))
                @php 
                    $platform = str_replace('_url', '', $key); 
                @endphp

                <a href="{{ $url }}" 
                   target="_blank" 
                   rel="noopener noreferrer"
                   title="{{ ucfirst($platform) }}"
                   class="w-9 h-9 rounded-xl border border-slate-800 flex items-center justify-center text-slate-400 transition-all duration-300 hover:-translate-y-1 group/icon relative overflow-hidden bg-slate-900/20"
                   data-platform="{{ $platform }}">
                    
                    {{-- كود الـ SVG الخاص بكل منصة رقمية بالتفصيل --}}
                    @if($platform === 'facebook')
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="group-hover/icon:text-[#1877F2] transition-colors duration-300"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                    @elseif($platform === 'instagram')
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="group-hover/icon:text-[#E1306C] transition-colors duration-300"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r=".6" fill="currentColor"/></svg>
                    @elseif($platform === 'linkedin')
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="group-hover/icon:text-[#0077B5] transition-colors duration-300"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
                    @elseif(in_array($platform, ['twitter', 'x']))
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="group-hover/icon:text-white transition-colors duration-300"><path d="M4 4l11.733 16h4.267l-11.733 -16z"/><path d="M4 20l6.768 -6.768m2.46 -2.46l6.772 -6.772"/></svg>
                    @elseif($platform === 'tiktok')
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="group-hover/icon:text-[#00f2fe] transition-colors duration-300"><path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"/></svg>
                    @elseif($platform === 'youtube')
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="group-hover/icon:text-[#FF0000] transition-colors duration-300"><rect x="2" y="3" width="20" height="18" rx="2" ry="2"/><path d="M10 9l5 3-5 3z"/></svg>
                    @elseif($platform === 'behance')
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="group-hover/icon:text-[#0057ff] transition-colors duration-300"><path d="M12 12H3V9h9v3zm0 4H3v-3h9v3zm1-7h8v2h-8V9zm1 4.5c0 1.38 1.12 2.5 2.5 2.5s2.5-1.12 2.5-2.5-1.12-2.5-2.5-2.5-2.5 1.12-2.5 2.5z"/></svg>
                    @elseif($platform === 'pinterest')
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="group-hover/icon:text-[#BD081C] transition-colors duration-300"><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/><circle cx="12" cy="12" r="10"/></svg>
                    @elseif($platform === 'whatsapp')
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="group-hover/icon:text-[#25D366] transition-colors duration-300"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
                    @elseif($platform === 'messenger')
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="group-hover/icon:text-[#25D366] transition-colors duration-300"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
                    @else
                        {{-- أيقونة الموقع الافتراضية في حال إضافة رابط خارجي مخصص --}}
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="group-hover/icon:text-[#C5A24A] transition-colors duration-300"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                    @endif

                </a>
            @endif
        @endforeach
    </div>
</div>
</div>
    </div>
</footer>

<script>
    function filterPortfolio(category, button) {
        document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
        button.classList.add('active');

        document.querySelectorAll('.portfolio-item').forEach(item => {
            if (category === 'all' || item.classList.contains(category)) {
                item.style.display = 'block';
                setTimeout(() => item.style.opacity = '1', 50);
            } else {
                item.style.opacity = '0';
                setTimeout(() => item.style.display = 'none', 300);
            }
        });
    }

    function reveal() {
        const reveals = document.querySelectorAll(".reveal");
        reveals.forEach(element => {
            const windowHeight = window.innerHeight;
            const elementTop = element.getBoundingClientRect().top;
            const elementVisible = 80; // تم تقليل القيمة لسرعة استجابة الحركة أثناء السكرول
            if (elementTop < windowHeight - elementVisible) {
                element.classList.add("active");
            }
        });
    }

    window.addEventListener("scroll", reveal);
    window.addEventListener("DOMContentLoaded", reveal);

    // scroll-spy: active nav link based on visible section
    const navLinks = document.querySelectorAll('.nav-link');
    const sections = ['home', 'services', 'portfolio', 'process', 'contact']
        .map(id => document.getElementById(id))
        .filter(Boolean);

    function updateActiveNav() {
        let currentId = sections[0]?.id;
        const scrollPos = window.scrollY + 120;
        sections.forEach(sec => {
            if (sec.offsetTop <= scrollPos) currentId = sec.id;
        });
        navLinks.forEach(link => {
            const isActive = link.dataset.section === currentId;
            link.classList.toggle('text-secondary', isActive);
            link.classList.toggle('font-bold', isActive);
            link.classList.toggle('border-secondary', isActive);
            link.classList.toggle('text-primary', !isActive);
            link.classList.toggle('border-transparent', !isActive);
        });
    }
    window.addEventListener('scroll', updateActiveNav);
    window.addEventListener('DOMContentLoaded', updateActiveNav);

    // mobile menu toggle
    const menuToggle = document.getElementById('menuToggle');
    const mobileMenu = document.getElementById('mobileMenu');
    const menuIcon = document.getElementById('menuIcon');
    if (menuToggle) {
        menuToggle.addEventListener('click', () => {
            const isOpen = !mobileMenu.classList.contains('hidden');
            mobileMenu.classList.toggle('hidden');
            menuIcon.textContent = isOpen ? 'menu' : 'close';
        });
        mobileMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
                menuIcon.textContent = 'menu';
            });
        });
    }

    // contact form — التحقق وإرسال البيانات لقاعدة البيانات
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        const checks = {
            'f-name':    v => v.trim().length >= 2,
            'f-email':   v => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v.trim()),
            'f-phone':   v => /^[0-9+\s-]{7,15}$/.test(v.trim()),
            'f-service': v => v !== ''
        };

        function clearError(id) {
            const el = document.getElementById(id);
            const err = document.getElementById('err-' + id.replace('f-', ''));
            el.classList.remove('field-error');
            if (err) err.classList.remove('show');
        }

        function setError(id) {
            const el = document.getElementById(id);
            const err = document.getElementById('err-' + id.replace('f-', ''));
            el.classList.add('field-error');
            if (err) err.classList.add('show');
        }

        Object.keys(checks).forEach(id => {
            const el = document.getElementById(id);
            el.addEventListener('input', () => {
                if (checks[id](el.value)) clearError(id);
            });
        });

        contactForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            let valid = true;
            Object.keys(checks).forEach(id => {
                const el = document.getElementById(id);
                if (checks[id](el.value)) {
                    clearError(id);
                } else {
                    setError(id);
                    valid = false;
                }
            });

            if (!valid) return;

            // إرسال البيانات لقاعدة البيانات عبر الـ API
            const submitBtn = contactForm.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span>جارٍ الإرسال...</span><span 