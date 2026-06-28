<!DOCTYPE html>
<html dir="rtl" lang="ar" class="scroll-smooth">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $project->title }} | {{ $settings['site_name'] ?? 'Wasm Media' }}</title>
    <meta name="description" content="{{ \Illuminate\Support\Str::limit(strip_tags($project->short_description), 150) }}">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:title" content="{{ $project->title }} | {{ $settings['site_name'] ?? 'Wasm Media' }}">
    <meta property="og:description" content="{{ \Illuminate\Support\Str::limit(strip_tags($project->short_description), 150) }}">
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ url()->current() }}">
    @if($project->cover_image)
        <meta property="og:image" content="{{ $project->cover_image_url }}">
    @endif

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
        .lines-layer {
            background-image: linear-gradient(rgba(23, 46, 102, 0.015) 1px, transparent 1px),
                              linear-gradient(90deg, rgba(23, 46, 102, 0.015) 1px, transparent 1px);
            background-size: 60px 60px;
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
    </style>
</head>
<body class="text-slate-800 antialiased overflow-x-hidden">

@php
    $logoVal = $settings['logo'] ?? null;
    $logoUrl = !empty($logoVal)
        ? ((str_starts_with($logoVal, 'http') || str_starts_with($logoVal, '/')) ? $logoVal : asset('storage/' . $logoVal))
        : null;
    $siteName = $settings['site_name'] ?? 'Wasm Media';

    // بناء روابط صور المعرض بأمان
    $gallery = collect($project->gallery_images ?? [])
        ->filter()
        ->map(fn ($img) => str_starts_with($img, 'http') ? $img : asset('storage/' . $img))
        ->values();
@endphp

<!-- القائمة العلوية Navbar -->
<header class="bg-white/90 backdrop-blur-md fixed w-full top-0 shadow-sm z-50 transition-all border-b border-slate-100">
    <div class="flex justify-between items-center w-full px-6 max-w-[1240px] mx-auto h-20">
        <a href="{{ route('home') }}" class="flex items-center gap-2 h-full py-3">
            @if($logoUrl)
                <img src="{{ $logoUrl }}" alt="{{ $siteName }}" class="h-full w-auto object-contain max-h-[52px]">
            @else
                <span class="text-xl md:text-2xl font-black text-[#172E66] tracking-tight">{{ $siteName }}</span>
            @endif
        </a>
        <nav class="hidden md:flex gap-8 items-center font-semibold text-sm">
            <a class="nav-link text-[#172E66] hover:text-[#C5A24A] pb-1 border-b-2 border-transparent transition-all" href="{{ route('home') }}#home">الرئيسية</a>
            <a class="nav-link text-[#172E66] hover:text-[#C5A24A] pb-1 border-b-2 border-transparent transition-all" href="{{ route('home') }}#services">خدماتنا</a>
            <a class="nav-link text-[#172E66] hover:text-[#C5A24A] font-bold border-b-2 border-[#C5A24A] pb-1 transition-all" href="{{ route('home') }}#portfolio">أعمالنا</a>
            <a class="nav-link text-[#172E66] hover:text-[#C5A24A] pb-1 border-b-2 border-transparent transition-all" href="{{ route('home') }}#process">منهجيتنا</a>
        </nav>
        <a href="{{ route('home') }}#contact" class="hidden sm:inline-flex bg-[#172E66] text-white text-xs md:text-sm font-bold px-6 py-3 rounded-xl hover:bg-[#0B1633] transition-all shadow-md shadow-blue-900/10">
            اتصل بنا
        </a>
    </div>
</header>

<main class="pt-20">

    <!-- ترويسة المشروع -->
    <section class="relative overflow-hidden bg-[#FDFDFB] pt-16 pb-12 md:pt-20 md:pb-16">
        <div class="absolute inset-0 w-full h-full opacity-100 lines-layer -z-10"></div>
        <div class="absolute top-10 left-5 w-[400px] h-[400px] bg-[#172E66]/5 rounded-full blur-[120px] -z-10"></div>
        <div class="absolute bottom-0 right-5 w-[360px] h-[360px] bg-[#C5A24A]/8 rounded-full blur-[110px] -z-10"></div>

        <div class="max-w-[1100px] mx-auto px-6 relative z-10">
            <!-- مسار التنقل -->
            <nav class="flex items-center gap-2 text-xs font-bold text-slate-500 mb-6 reveal" aria-label="مسار التنقل">
                <a href="{{ route('home') }}" class="hover:text-[#172E66] transition-colors">الرئيسية</a>
                <span class="material-symbols-outlined text-sm">chevron_left</span>
                <a href="{{ route('home') }}#portfolio" class="hover:text-[#172E66] transition-colors">أعمالنا</a>
                <span class="material-symbols-outlined text-sm">chevron_left</span>
                <span class="text-[#172E66] truncate max-w-[200px]">{{ $project->title }}</span>
            </nav>

            <div class="flex flex-wrap items-center gap-2 mb-4 reveal">
                <span class="text-[11px] font-bold text-white bg-[#C5A24A] px-3 py-1.5 rounded-full">{{ $project->category_label }}</span>
                @if($project->service)
                    <span class="text-[11px] font-bold text-[#172E66] bg-[#172E66]/10 px-3 py-1.5 rounded-full">{{ $project->service->title }}</span>
                @endif
            </div>

            <h1 class="reveal text-3xl md:text-5xl text-[#172E66] font-black leading-[1.25] mb-5 max-w-3xl">
                {{ $project->title }}
            </h1>

            <p class="reveal text-sm md:text-base text-slate-600 font-medium leading-relaxed max-w-2xl">
                {{ $project->short_description }}
            </p>
        </div>
    </section>

    <!-- صورة الغلاف -->
    <section class="bg-[#FDFDFB] pb-4">
        <div class="max-w-[1100px] mx-auto px-6">
            <div class="reveal rounded-3xl overflow-hidden shadow-2xl border border-slate-200/50 aspect-[16/9] w-full flex items-center justify-center"
                 style="background-color: {{ $project->accent_color ?? '#172E66' }};">
                @if($project->cover_image)
                    <img src="{{ $project->cover_image_url }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
                @else
                    @if($logoUrl)
                        <img src="{{ $logoUrl }}" alt="{{ $siteName }}" class="h-16 w-auto brightness-0 invert opacity-90">
                    @else
                        <span class="text-3xl font-black text-white/90">{{ $siteName }}</span>
                    @endif
                @endif
            </div>
        </div>
    </section>

    <!-- التفاصيل + معلومات جانبية -->
    <section class="py-16 md:py-20 bg-white">
        <div class="max-w-[1100px] mx-auto px-6 grid grid-cols-1 lg:grid-cols-12 gap-10">
            <!-- الوصف التفصيلي -->
            <div class="lg:col-span-8 reveal">
                <h2 class="text-xl md:text-2xl text-[#172E66] font-extrabold mb-5">نبذة عن المشروع</h2>
                <div class="prose prose-slate max-w-none text-sm md:text-base text-slate-600 leading-[1.9] space-y-4 whitespace-pre-line">{{ $project->full_description ?: $project->short_description }}</div>
            </div>

            <!-- بطاقة المعلومات -->
            <aside class="lg:col-span-4 reveal">
                <div class="glass-card rounded-2xl p-6 md:p-7 lg:sticky lg:top-28">
                    <h3 class="text-sm font-extrabold text-[#172E66] mb-5 pb-4 border-b border-slate-200">معلومات المشروع</h3>
                    <dl class="space-y-4 text-sm">
                        @if($project->client_name)
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-[#C5A24A] text-lg">apartment</span>
                            <div>
                                <dt class="text-[11px] text-slate-400 font-bold">العميل</dt>
                                <dd class="text-[#172E66] font-bold">{{ $project->client_name }}</dd>
                            </div>
                        </div>
                        @endif
                        @if($project->service)
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-[#C5A24A] text-lg">category</span>
                            <div>
                                <dt class="text-[11px] text-slate-400 font-bold">الخدمة</dt>
                                <dd class="text-[#172E66] font-bold">{{ $project->service->title }}</dd>
                            </div>
                        </div>
                        @endif
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-[#C5A24A] text-lg">sell</span>
                            <div>
                                <dt class="text-[11px] text-slate-400 font-bold">التصنيف</dt>
                                <dd class="text-[#172E66] font-bold">{{ $project->category_label }}</dd>
                            </div>
                        </div>
                    </dl>
                    <a href="{{ route('home') }}#contact" class="mt-6 w-full inline-flex items-center justify-center gap-2 bg-[#172E66] text-white text-xs font-bold py-3 rounded-xl hover:bg-[#0B1633] transition-all">
                        <span>اطلب مشروعاً مشابهاً</span>
                        <span class="material-symbols-outlined text-sm">arrow_back</span>
                    </a>
                </div>
            </aside>
        </div>
    </section>

    <!-- معرض الصور -->
    @if($gallery->isNotEmpty())
    <section class="pb-16 md:pb-20 bg-white">
        <div class="max-w-[1100px] mx-auto px-6">
            <h2 class="text-xl md:text-2xl text-[#172E66] font-extrabold mb-8 reveal">معرض المشروع</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                @foreach($gallery as $img)
                    <div class="reveal rounded-2xl overflow-hidden shadow-md border border-slate-200/50 bg-slate-100">
                        <img src="{{ $img }}" alt="{{ $project->title }}" loading="lazy" class="w-full h-full object-cover hover:scale-105 transition-transform duration-700">
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- مشاريع مرتبطة -->
    @if($related->isNotEmpty())
    <section class="py-16 md:py-20 bg-[#FDFDFB] border-t border-slate-100">
        <div class="max-w-[1240px] mx-auto px-6">
            <h2 class="text-xl md:text-2xl text-[#172E66] font-extrabold mb-8 reveal">مشاريع قد تعجبك</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($related as $item)
                    <a href="{{ route('projects.show', $item->slug) }}" class="reveal group relative overflow-hidden rounded-2xl bg-primary shadow-sm transition-all duration-500 hover:shadow-xl hover:-translate-y-1.5 block">
                        <div class="aspect-[4/3] w-full relative grayscale group-hover:grayscale-0 transition-all duration-700 flex items-center justify-center" style="background-color: {{ $item->accent_color ?? '#172E66' }};">
                            @if($item->cover_image)
                                <img src="{{ $item->cover_image_url }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                            @else
                                <div class="absolute -left-10 -top-10 w-48 h-48 rounded-full border-[16px] border-white/5"></div>
                            @endif
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-primary via-primary/20 to-transparent flex flex-col justify-end p-6">
                            <span class="text-[9px] font-bold text-white bg-secondary px-2.5 py-1 rounded-full w-fit mb-2">{{ $item->category_label }}</span>
                            <h3 class="text-on-primary text-lg font-bold line-clamp-1">{{ $item->title }}</h3>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- دعوة لاتخاذ إجراء -->
    <section class="py-16 md:py-20 bg-gradient-primary text-white">
        <div class="max-w-[900px] mx-auto px-6 text-center">
            <h2 class="text-2xl md:text-3xl font-black mb-4 reveal">عندك مشروع في بالك؟</h2>
            <p class="text-sm md:text-base text-white/80 mb-8 max-w-xl mx-auto reveal">دعنا نحوّل فكرتك إلى هوية وحضور لا يُنسى، تماماً كما فعلنا مع شركائنا.</p>
            <a href="{{ route('home') }}#contact" class="reveal inline-flex items-center gap-2 bg-white text-[#172E66] text-sm font-bold px-8 py-4 rounded-xl hover:bg-slate-100 transition-all shadow-lg">
                <span>ابدأ مشروعك معنا</span>
                <span class="material-symbols-outlined text-sm">arrow_back</span>
            </a>
        </div>
    </section>

</main>

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
            <div class="flex flex-wrap gap-3 justify-center">
                @foreach($settings as $key => $url)
                    @if(str_ends_with($key, '_url') && !empty($url))
                        @php $platform = str_replace('_url', '', $key); @endphp
                        <a href="{{ $url }}" target="_blank" rel="noopener noreferrer" title="{{ ucfirst($platform) }}"
                           class="w-9 h-9 rounded-xl border border-slate-800 flex items-center justify-center text-slate-400 transition-all duration-300 hover:-translate-y-1 hover:text-[#C5A24A] bg-slate-900/20">
                            <span class="material-symbols-outlined text-base">public</span>
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</footer>

<script>
    // ظهور تدريجي للعناصر عند التمرير (نفس سلوك الصفحة الرئيسية)
    function reveal() {
        document.querySelectorAll('.reveal').forEach(el => {
            if (el.getBoundingClientRect().top < window.innerHeight - 60) {
                el.classList.add('active');
            }
        });
    }
    window.addEventListener('scroll', reveal);
    window.addEventListener('DOMContentLoaded', reveal);
</script>

@include('partials.whatsapp')

</body>
</html>
