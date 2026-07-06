<!DOCTYPE html>
<html dir="rtl" lang="ar" class="scroll-smooth">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        $logoValHead = $settings['logo'] ?? null;
        $logoUrlHead = !empty($logoValHead)
            ? ((str_starts_with($logoValHead, 'http') || str_starts_with($logoValHead, '/')) ? $logoValHead : asset('storage/' . $logoValHead))
            : asset('images/logo.svg');
        $siteNameHead = $settings['site_name'] ?? 'Wasm Media';
        $siteDesc = 'وكالة وسم ميديا الإبداعية: هوية بصرية، تسويق رقمي، صناعة محتوى، وحلول التغليف والطباعة الفاخرة.';
        $ogImage = $logoUrlHead;
    @endphp

    <title>{{ $siteNameHead }} | وكالة إبداعية متخصصة</title>
    <meta name="description" content="{{ $siteDesc }}">
    <meta name="robots" content="index, follow">
    <meta name="author" content="{{ $siteNameHead }}">
    <link rel="canonical" href="{{ url('/') }}">

    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:title" content="{{ $siteNameHead }} | وكالة إبداعية متخصصة">
    <meta property="og:description" content="{{ $siteDesc }}">
    <meta property="og:image" content="{{ $ogImage }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="{{ $siteNameHead }}">
    <meta property="og:site_name" content="{{ $siteNameHead }}">
    <meta property="og:locale" content="ar_SA">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $siteNameHead }} | وكالة إبداعية متخصصة">
    <meta name="twitter:description" content="{{ $siteDesc }}">
    <meta name="twitter:image" content="{{ $ogImage }}">

    <link rel="icon" type="image/svg+xml" href="{{ $logoUrlHead }}">
    <link rel="alternate icon" href="{{ $logoUrlHead }}">
    <link rel="apple-touch-icon" href="{{ $logoUrlHead }}">
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#172E66">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

@vite(['resources/css/app.css', 'resources/js/app.js'])

<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

    @php
        $jsonSocialLinks = [];
        foreach ($settings as $k => $v) {
            if (str_ends_with($k, '_url') && !empty($v) && filter_var($v, FILTER_VALIDATE_URL)) {
                $jsonSocialLinks[] = e($v);
            }
        }
        $jsonLd = [
            '@context' => 'https://schema.org',
            '@type' => 'LocalBusiness',
            'name' => $siteNameHead,
            'description' => $siteDesc,
            'url' => url('/'),
            'logo' => $ogImage,
            'image' => $ogImage,
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'contactType' => 'customer service',
                'availableLanguage' => ['Arabic', 'English'],
            ],
            'sameAs' => $jsonSocialLinks,
        ];
    @endphp
    <script type="application/ld+json">{!! json_encode($jsonLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}</script>
</head>
<body class="text-slate-800 antialiased overflow-x-hidden">

@php
    $logoUrl = $logoUrlHead;
    $siteName = $siteNameHead;
    $videoVal = $settings['video'] ?? null;
    $videoUrl = !empty($videoVal)
        ? ((str_starts_with($videoVal, 'http') || str_starts_with($videoVal, '/')) ? $videoVal : asset('storage/' . $videoVal))
        : null;
@endphp

<header class="bg-white/90 backdrop-blur-md fixed w-full top-0 shadow-sm z-50 transition-all border-b border-slate-100">
    <div class="flex justify-between items-center w-full px-6 max-w-[1240px] mx-auto h-20">
        <a href="#home" class="flex items-center gap-2 h-full py-3">
            @if($logoUrl)
                <img src="{{ $logoUrl }}" alt="{{ $siteName }}" class="h-full w-auto object-contain max-h-[52px]">
            @else
                <span class="text-xl md:text-2xl font-black text-[#172E66] tracking-tight">{{ $siteName }}</span>
            @endif
        </a>
        <nav class="hidden md:flex gap-8 items-center font-semibold text-sm" id="desktopNav">
            <a class="nav-link text-[#172E66] hover:text-[#C5A24A] font-bold border-b-2 border-[#C5A24A] pb-1 transition-all" href="#home" data-section="home">الرئيسية</a>
            <a class="nav-link text-[#172E66] hover:text-[#C5A24A] pb-1 border-b-2 border-transparent transition-all" href="#services" data-section="services">خدماتنا</a>
            <a class="nav-link text-[#172E66] hover:text-[#C5A24A] pb-1 border-b-2 border-transparent transition-all" href="#portfolio" data-section="portfolio">أعمالنا</a>
            <a class="nav-link text-[#172E66] hover:text-[#C5A24A] pb-1 border-b-2 border-transparent transition-all" href="#process" data-section="process">منهجيتنا</a>
        </nav>
        <div class="flex items-center gap-3">
            <a href="#contact" class="hidden sm:inline-flex bg-[#172E66] text-white text-xs md:text-sm font-bold px-6 py-3 rounded-xl hover:bg-[#0B1633] transition-all shadow-md shadow-blue-900/10">
                اتصل بنا
            </a>
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
            <a href="#contact" class="bg-[#172E66] text-white text-sm font-bold px-6 py-3 rounded-xl text-center mt-2">اتصل بنا</a>
        </nav>
    </div>
</header>

<main class="pt-20">

<section id="home" class="relative min-h-screen flex items-center justify-center overflow-hidden pt-32 pb-24 bg-gradient-to-br from-[#0B1633] via-[#12234E] to-[#0B1633]">

    <div class="absolute inset-0 w-full h-full opacity-65 mix-blend-screen lines-layer-dark pointer-events-none"></div>

    <div class="absolute top-0 left-0 w-[500px] md:w-[700px] h-[500px] md:h-[700px] bg-[#C5A24A]/10 rounded-full blur-[130px] animate-pulse-slow -z-10"></div>
    <div class="absolute bottom-0 right-0 w-[450px] md:w-[650px] h-[450px] md:h-[650px] bg-[#3B5AA0]/20 rounded-full blur-[120px] animate-pulse-slow-reverse -z-10"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-[#C5A24A]/5 rounded-full blur-[150px] -z-10"></div>

    <div class="absolute inset-0 -z-10 overflow-hidden">
        <span class="particle particle-1"></span>
        <span class="particle particle-2"></span>
        <span class="particle particle-3"></span>
        <span class="particle particle-4"></span>
    </div>

    <div class="max-w-[1240px] mx-auto px-6 relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center w-full">

        <div class="lg:col-span-6 text-right flex flex-col justify-center items-start">
            
            <div class="reveal inline-flex items-center gap-2 bg-white/5 border border-[#C5A24A]/35 backdrop-blur-md text-[#EAD08B] px-4 py-2 rounded-full text-xs font-medium mb-6 shadow-sm">
                <span class="w-2 h-2 rounded-full bg-[#C5A24A] animate-ping"></span>
                <span>نصنع الأثر ونبني الهوية</span>
            </div>

            <h1 class="reveal text-4xl md:text-5xl lg:text-6xl text-white mb-6 leading-[1.3] font-bold tracking-wide">
                @if(!empty($settings['hero_title']))
                    {!! $settings['hero_title'] !!}
                @else
                    نصمم هوية <span class="text-gradient-gold font-bold">تترك أثراً</span> ونبني حضوراً يُلاحَظ
                @endif
            </h1>

            <p class="reveal text-sm md:text-base text-slate-200/90 mb-8 max-w-xl font-normal leading-loose">
               {{ $settings['hero_subtitle'] ?? '' }}
            </p>

            <div class="reveal flex flex-col sm:flex-row gap-4 w-full sm:w-auto" style="transition-delay: 200ms;">
                <a href="#contact" class="bg-[#C5A24A] text-[#0B1633] text-xs md:text-sm font-bold px-8 py-4 rounded-xl hover:bg-[#EAD08B] transition-all shadow-lg shadow-black/20 text-center min-w-[180px]">
                    اطلب استشارة مجانية
                </a>
                <a href="#portfolio" class="bg-white/5 border border-white/20 backdrop-blur-md text-white text-xs md:text-sm font-bold px-8 py-4 rounded-xl hover:bg-white/10 transition-all text-center min-w-[180px]">
                    استكشف أعمالنا
                </a>
            </div>

        </div>

        <div class="lg:col-span-6 w-full reveal" style="transition-delay: 150ms;">
            <div class="relative">
                <div class="absolute -inset-1 bg-gradient-to-r from-[#C5A24A]/30 to-[#3B5AA0]/30 rounded-3xl blur-xl opacity-60 animate-pulse-slow"></div>

                <div class="glass-video-card-dark p-3 md:p-4 rounded-3xl relative shadow-2xl border border-white/10 max-w-xl mx-auto lg:mr-auto lg:ml-0 group">
                    <div class="relative aspect-[16/9] w-full rounded-2xl overflow-hidden shadow-inner bg-[#0B1633]">
                        @if($videoUrl)
                        <video class="w-full h-full object-cover opacity-100 scale-100 group-hover:scale-105 transition-transform duration-1000"
                               autoplay loop muted playsinline
                               oncanplay="this.play()" onloadedmetadata="this.muted = true">
                            <source src="{{ $videoUrl }}" type="video/mp4">
                        </video>
                        @else
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-[#0B1633] via-[#172E66] to-[#0B1633] relative overflow-hidden">
                            <div class="absolute inset-0 lines-layer-dark opacity-40"></div>
                            @if($logoUrl)
                                 <img src="{{ $logoUrl }}" alt="{{ $siteName }}" class="h-14 w-auto brightness-0 invert opacity-95 relative z-10 floating-logo">
                            @else
                                 <span class="text-2xl font-bold text-white/90 tracking-tight relative z-10">{{ $siteName }}</span>
                            @endif
                        </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0B1633]/50 via-transparent to-transparent pointer-events-none"></div>
                        
                        <div class="absolute bottom-4 right-4 bg-white/10 backdrop-blur-md px-3 py-1.5 rounded-lg border border-white/20 z-20">
                            @if($logoUrl)
                                <img src="{{ $logoUrl }}" alt="{{ $siteName }}" class="h-5 w-auto brightness-0 invert">
                            @else
                                <span class="text-xs font-bold text-white">{{ $siteName }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

{{-- <div id="videoModal" class="fixed inset-0 bg-black/90 z-[100] hidden opacity-0 transition-opacity duration-300 flex items-center justify-center p-4">
    <button onclick="closeVideoModal()" class="absolute top-6 left-6 text-white hover:text-[#C5A24A] bg-white/10 p-3 rounded-full transition-colors">
        <span class="material-symbols-outlined text-2xl">close</span>
    </button>
    <div class="w-full max-w-4xl aspect-[16/9] rounded-2xl overflow-hidden shadow-2xl border border-white/10 bg-black">
        <video id="modalVideo" class="w-full h-full object-contain" controls>
            <source src="https://assets.mixkit.co/videos/preview/mixkit-digital-animation-of-a-logo-reveal-41662-large.mp4" type="video/mp4">
        </video>
    </div>
</div> --}}

<section class="py-10 bg-[#F9F9F6] relative z-20" id="statistics">
    <div class="max-w-[1000px] mx-auto px-6">

        @if(!empty($stats) && $stats->count())
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                @foreach($stats as $stat)
                    @php $delay = $loop->iteration * 75 - 75; @endphp

                    <div class="reveal transition-all duration-300 hover:-translate-y-1" style="transition-delay: {{ $delay }}ms;">

                        <h3 class="text-3xl md:text-4xl text-[#172E66] font-black tracking-tight mb-1.5 leading-none">
                            {{ $stat->value }}
                        </h3>

                        <div class="flex items-center justify-center gap-1.5 text-slate-500">
                            @if(!empty($stat->icon))
                                <span class="material-symbols-outlined text-xs text-[#C5A24A]" style="font-variation-settings: 'FILL' 1;">{{ $stat->icon }}</span>
                            @endif
                            <p class="text-xs md:text-sm font-bold tracking-wide text-slate-400">
                                {{ $stat->label }}
                            </p>
                        </div>

                    </div>
                @endforeach
            </div>
        @else
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="reveal">
                    <h3 class="text-3xl md:text-4xl text-[#172E66] font-black tracking-tight mb-1.5 leading-none">120+</h3>
                    <div class="flex items-center justify-center gap-1.5 text-slate-400">
                        <span class="material-symbols-outlined text-xs text-[#C5A24A]" style="font-variation-settings: 'FILL' 1;">groups</span>
                        <p class="text-xs md:text-sm font-bold">عميل سعيد</p>
                    </div>
                </div>
            </div>
        @endif

    </div>
</section>

<section class="py-12 md:py-16 bg-[#F9F9F6] text-[#172E66] relative overflow-hidden" id="services">
    <div class="absolute top-0 left-1/4 w-80 h-80 bg-[#172E66]/5 rounded-full blur-[90px] pointer-events-none"></div>

    <div class="max-w-[1140px] mx-auto px-6 relative z-10">

        <div class="border-b border-slate-200/60 pb-8 mb-10 reveal flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div class="max-w-xl">
                <div class="inline-flex items-center gap-1.5 bg-[#172E66]/5 text-[#172E66] px-3 py-1 rounded-full text-[10px] font-bold mb-3 border border-[#172E66]/10">
                    <span class="material-symbols-outlined text-xs">grid_view</span>
                    <span>تخصصاتنا ومجالاتنا الإبداعية</span>
                </div>
                <h2 class="text-xl md:text-2xl text-[#172E66] font-black leading-tight tracking-tight">
                    نحن لا نبيع خدمات، بل <span class="text-[#C5A24A]">نصنع حلول نمو</span> متكاملة ومترابطة
                </h2>
            </div>
            {{-- <p class="text-slate-500 text-xs md:text-sm leading-relaxed font-medium max-w-xs md:text-left">
                منظومة عمل مرنة وواضحة تضمن لك تدفقاً يسيراً للمعلومات بأعلى جودة.
            </p> --}}
        </div>

        @if(!empty($services) && $services->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach($services as $service)

                    <div class="bg-white border border-slate-200/60 p-5 rounded-xl flex flex-col justify-between transition-all duration-300 hover:border-[#172E66]/20 hover:-translate-y-1 hover:shadow-[0_12px_24px_-10px_rgba(23,46,102,0.06)] group relative overflow-hidden">

                        <div class="absolute bottom-0 left-0 w-full h-[2.5px] bg-[#C5A24A] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-right"></div>

                        <div>
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-9 h-9 bg-[#172E66]/5 text-[#172E66] rounded-lg flex items-center justify-center transition-all duration-300 group-hover:bg-[#172E66] group-hover:text-white flex-shrink-0">
                                    <span class="material-symbols-outlined text-base font-bold">{{ $service->icon ?? 'brush' }}</span>
                                </div>
                                <h3 class="text-sm md:text-base text-[#172E66] font-black tracking-tight leading-none">
                                    {{ $service->title }}
                                </h3>
                            </div>

                            @if(!empty($service->description))
                                <p class="text-slate-500 text-[11px] md:text-xs leading-relaxed font-medium line-clamp-3">
                                    {{ $service->description }}
                                </p>
                            @endif
                        </div>

                    </div>

                @endforeach
            </div>
        @else
            <div class="max-w-xs mx-auto text-center py-8 border border-slate-200/60 bg-white rounded-xl shadow-sm">
                <div class="w-9 h-9 bg-slate-50 text-slate-400 rounded-lg flex items-center justify-center mx-auto mb-3">
                    <span class="material-symbols-outlined text-base">layers_clear</span>
                </div>
                <h3 class="text-xs md:text-sm text-[#172E66] mb-1 font-bold">الخدمات قيد التحديث</h3>
                <p class="text-slate-400 text-[11px] max-w-xs mx-auto">نعمل حالياً على صياغة قائمة خدماتنا الإبداعية.</p>
            </div>
        @endif

    </div>
</section>

<section class="py-20 md:py-24 bg-white border-t border-slate-100" id="portfolio">
    <div class="max-w-[1240px] mx-auto px-6">

        <!-- رأس القسم وأزرار الفلترة الديناميكية -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 pb-6 mb-12 border-b border-slate-100 reveal">
    
    <div class="max-w-xl">
        <h2 class="text-2xl md:text-3xl text-[#172E66] mb-2 font-black tracking-tight">معرض أعمالنا الاستراتيجية</h2>
        <p class="text-slate-500 text-xs md:text-sm leading-relaxed">تصفح كيف ساعدنا شركاءنا على تحويل أهدافهم لقصص نجاح واقعية ومبهرة.</p>
    </div>

   <div class="flex flex-wrap items-center gap-1 bg-slate-100 p-1 rounded-xl border border-slate-200 shadow-sm backdrop-blur-sm w-fit">
    <button id="btn-filter-all" class="filter-btn text-xs font-bold px-4 py-1.5 rounded-lg transition-all cursor-pointer bg-[#172E66] text-white shadow-sm" onclick="filterPortfolio('all', this)">
        الكل
    </button>
    
    @if(!empty($services))
        @foreach($services as $service)
            <button class="filter-btn text-xs font-bold px-4 py-1.5 rounded-lg transition-all cursor-pointer text-slate-600 hover:text-[#172E66] hover:bg-white/50" 
                    onclick="filterPortfolio('{{ trim($service->slug) }}', this)">
                {{ $service->title }}
            </button>
        @endforeach
    @endif
</div>

</div>

        <!-- شبكة المشاريع المحمية بالـ data-category -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="portfolio-grid">
    @forelse($projects as $project)
        <a href="{{ route('projects.show', $project->slug) }}"
           data-category="{{ trim($project->service?->slug ?? 'none') }}"
           class="portfolio-item block group relative overflow-hidden rounded-2xl bg-[#0B1633] shadow-sm cursor-pointer transition-all duration-500 hover:shadow-xl hover:-translate-y-1.5">

            <div class="aspect-[4/3] w-full relative transition-all duration-700 flex items-center justify-center overflow-hidden" style="background-color: {{ $project->accent_color ?? '#172E66' }};">
                @if($project->cover_image)
                    <img src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ $project->title }}" loading="lazy" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                @else
                    <div class="absolute -left-10 -top-10 w-48 h-48 rounded-full border-[16px] border-white/5"></div>
                    <div class="absolute left-16 bottom-6 w-24 h-24 rounded-full border-[10px] border-white/10"></div>
                @endif
            </div>

            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent flex flex-col justify-end p-6">
                <div class="flex gap-2 mb-2">
                    <span class="text-[9px] font-bold text-white bg-[#C5A24A] px-2.5 py-1 rounded-full truncate max-w-full">
                        {{ $project->category_label ?? ($project->service?->title ?? 'مشروع إبداعي') }}
                    </span>
                </div>
                <h3 class="text-white text-lg mb-1 font-bold line-clamp-1" title="{{ $project->title }}">{{ $project->title }}</h3>
                <p class="text-slate-300 text-xs opacity-90 line-clamp-2">{{ $project->short_description }}</p>
            </div>
        </a>
    @empty
        <div class="col-span-full text-center py-12 bg-slate-50 rounded-2xl border border-dashed border-slate-200">
            <p class="text-xs text-slate-400 font-bold">لا توجد مشاريع مضافة حالياً في المعرض.</p>
        </div>
    @endforelse
</div>

        <div class="flex justify-center mt-12 reveal">
    <a href="{{ route('projects.index') }}" class="inline-flex items-center gap-2 bg-[#172E66] text-white text-xs md:text-sm font-bold px-8 py-4 rounded-xl hover:bg-[#0B1633] transition-all shadow-lg shadow-blue-900/10 group">
        <span>عرض جميع الأعمال</span>
        <span class="material-symbols-outlined text-sm transform group-hover:-translate-x-1 transition-transform">arrow_left_alt</span>
    </a>
</div>

    </div>
</section>

<section class="py-16 md:py-20 bg-[#FDFDFB]" id="process">
    <div class="max-w-[1240px] mx-auto px-6">

        <div class="text-center mb-12 reveal">
            <h2 class="text-2xl md:text-3xl text-[#172E66] mb-3 font-black">خطوات المنهجية المدروسة</h2>
            <p class="text-slate-500 max-w-2xl mx-auto text-xs md:text-sm">منظومة عمل مرنة وواضحة تضمن لك تدفقاً يسيراً للمعلومات وأفضل جودة للمخرجات النهائية بأقل مجهود منك.</p>
        </div>

        <div class="relative max-w-5xl mx-auto mt-10">

            <div class="hidden md:block absolute top-6 left-4 right-4 h-[1.5px] bg-slate-200 -z-10"></div>

            <div class="flex flex-col md:flex-row justify-center items-start gap-8 md:gap-4 relative z-10">

                @forelse($processSteps as $step)
                    @php
                        $n = $step->step_number ?? $loop->iteration;
                        $delay = $loop->iteration * 100 - 100;
                        $isLast = $loop->last;
                    @endphp

                    <div class="flex-1 w-full text-center reveal group" style="transition-delay: {{ $delay }}ms;">

                        <div class="w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4 font-black text-sm shadow-sm transition-all duration-300 group-hover:scale-110 group-hover:shadow-md
                            {{ $isLast ? 'bg-[#C5A24A] text-white' : 'bg-white text-[#172E66] border-[2px] border-[#172E66]' }}">
                            {{ sprintf('%02d', $n) }} </div>

                        <h3 class="text-sm md:text-base text-[#172E66] mb-2 font-bold group-hover:text-[#C5A24A] transition-colors duration-300">
                            {{ $step->title }}
                        </h3>

                        @if(!empty($step->description))
                            <p class="text-slate-500 text-[11px] md:text-xs leading-relaxed max-w-[220px] mx-auto opacity-90">
                                {{ $step->description }}
                            </p>
                        @endif
                    </div>

                @empty
                    <div class="w-full text-center reveal py-4">
                        <div class="w-12 h-12 bg-slate-100 text-slate-400 rounded-full flex items-center justify-center mx-auto mb-3 font-bold">!</div>
                        <h3 class="text-base text-[#172E66] mb-1 font-bold">الخطوات قيد التحديث</h3>
                        <p class="text-slate-400 text-xs">سيتم إضافة خطوات المنهجية قريباً.</p>
                    </div>
                @endforelse

            </div>
        </div>

    </div>
</section>

<section class="py-20 md:py-24 bg-surface-container-low relative overflow-hidden" id="contact">
    <!-- خلفية جمالية مدمجة بشكل آمن -->
    <div class="absolute top-1/2 left-0 w-96 h-96 bg-primary/5 rounded-full blur-3xl z-0 pointer-events-none"></div>

    <div class="max-w-[1240px] mx-auto px-6 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">

            <!-- القسم الأيمن: معلومات التواصل -->
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
                    <!-- البريد الإلكتروني -->
                    <div class="flex items-center gap-4 p-4 rounded-xl bg-white/50 border border-white/40 backdrop-blur-sm">
                        <div class="w-10 h-10 bg-primary/10 text-primary rounded-lg flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-lg">mail</span>
                        </div>
                        <div>
                            <p class="text-[10px] text-on-surface-variant font-bold">راسلنا مباشرة</p>
                            <p class="text-sm font-extrabold text-primary">{{ $settings['contact_email'] ?? 'hello@wasmmedia.com' }}</p>
                        </div>
                    </div>
                    <!-- رقم الجوال -->
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

            <!-- القسم الأيسر: فورم نموذج الاتصال -->
            <div class="lg:col-span-7 reveal" style="transition-delay: 150ms;">
                <div class="glass-card p-6 md:p-10 rounded-2xl shadow-xl border border-white/60">
                    <div id="formWrap">
                        <h3 class="text-lg md:text-xl text-primary font-extrabold mb-1">طلب استشارة مجانية</h3>
                        <p class="text-[11px] text-on-surface-variant mb-6 font-medium">احصل على تحليل أولي لعلامتك التجارية خلال 24 ساعة فقط.</p>

                        <form id="contactForm" class="space-y-5" novalidate>
                            @csrf <!-- يفضل وجودها دائماً في فورامات Laravel حتى لو تم إرسالها عبر Ajax -->

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="f-name" class="block text-[11px] font-bold text-primary mb-1.5">الاسم الكريم *</label>
                                    <input type="text" id="f-name" name="name" class="w-full bg-white/90 border border-primary/10 focus:border-primary focus:ring-0 rounded-xl px-4 py-3 text-xs md:text-sm transition-all placeholder-gray-400" placeholder="أدخل اسمك الكامل">
                                    <span class="field-error-msg hidden text-red-500 text-[10px] mt-1" id="err-name">الرجاء إدخال الاسم الكامل (حرفين على الأقل)</span>
                                </div>
                                <div>
                                    <label for="f-company" class="block text-[11px] font-bold text-primary mb-1.5">اسم المنشأة / الشركة</label>
                                    <input type="text" id="f-company" name="company" class="w-full bg-white/90 border border-primary/10 focus:border-primary focus:ring-0 rounded-xl px-4 py-3 text-xs md:text-sm transition-all placeholder-gray-400" placeholder="شركتك أو مشروعك">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="f-email" class="block text-[11px] font-bold text-primary mb-1.5">بريدك الإلكتروني *</label>
                                    <input type="email" id="f-email" name="email" class="w-full bg-white/90 border border-primary/10 focus:border-primary focus:ring-0 rounded-xl px-4 py-3 text-xs md:text-sm transition-all placeholder-gray-400" placeholder="name@company.com">
                                    <span class="field-error-msg hidden text-red-500 text-[10px] mt-1" id="err-email">الرجاء إدخال بريد إلكتروني صحيح</span>
                                </div>
                                <div>
                                    <label for="f-phone" class="block text-[11px] font-bold text-primary mb-1.5">رقم الجوال *</label>
                                    <input type="tel" id="f-phone" name="phone" class="w-full bg-white/90 border border-primary/10 focus:border-primary focus:ring-0 rounded-xl px-4 py-3 text-xs md:text-sm transition-all placeholder-gray-400" placeholder="+966">
                                    <span class="field-error-msg hidden text-red-500 text-[10px] mt-1" id="err-phone">الرجاء إدخال رقم جوال صحيح</span>
                                </div>
                            </div>

                            <div>
                                <label for="f-service" class="block text-[11px] font-bold text-primary mb-1.5">ما هو الحل الإبداعي الذي تبحث عنه؟ *</label>
                                <select id="f-service" name="service" class="w-full bg-white/90 border border-primary/10 focus:border-primary focus:ring-0 rounded-xl px-4 py-3 text-xs md:text-sm transition-all text-on-surface-variant">
                                    <option value="">اختر الخدمة المطلوبة</option>

                                    <!-- استخدام forelse الاحترافي لتنظيف الهيكل في Blade -->
                                    @forelse($services as $service)
                                        <option value="{{ $service->slug }}">{{ $service->title }}</option>
                                    @empty
                                        <option value="branding">استراتيجيات وتصميم هوية بصرية كاملة</option>
                                        <option value="packaging">تخطيط وتصميم التغليف والطباعة الفاخرة</option>
                                        <option value="marketing">إدارة الحملات التسويقية وصناعة المحتوى</option>
                                        <option value="digital">حلول رقمية وتصميم مواقع مخصصة</option>
                                    @endforelse

                                </select>
                                <span class="field-error-msg hidden text-red-500 text-[10px] mt-1" id="err-service">الرجاء اختيار نوع الخدمة</span>
                            </div>

                            <div>
                                <label for="f-message" class="block text-[11px] font-bold text-primary mb-1.5">تفاصيل إضافية حول مشروعك</label>
                                <textarea rows="3" id="f-message" name="message" class="w-full bg-white/90 border border-primary/10 focus:border-primary focus:ring-0 rounded-xl px-4 py-3 text-xs md:text-sm transition-all placeholder-gray-400 resize-none" placeholder="حدثنا باختصار عن أهدافك وميزانيتك المتوقعة..."></textarea>
                            </div>

                            <button type="submit" class="w-full bg-primary hover:bg-primary-container text-on-primary text-xs md:text-sm font-bold py-3.5 rounded-xl shadow-lg hover:shadow-xl transition-all flex items-center justify-center gap-2">
                                <span>إرسال الطلب وحجز الجلسة</span>
                                <span class="material-symbols-outlined text-sm">send</span>
                            </button>
                        </form>
                    </div>

                    <!-- صندوق النجاح (تأكد من إخفائه افتراضياً بـ hidden في كود الـ CSS أو الـ Tailwind لتتحكم به عبر الـ JS) -->
                    <div class="form-success-box hidden text-center py-6" id="formSuccess">
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

</main>

<footer class="bg-[#0B1633] text-white pt-10 pb-6 border-t border-slate-800/60 relative z-20">
    <div class="max-w-[1240px] mx-auto px-6">

        <div class="flex flex-col sm:flex-row justify-between items-center gap-6 pb-6 border-b border-slate-800/40">

            <div class="flex-shrink-0">
                @if($logoUrl)
                    <img src="{{ $logoUrl }}" alt="{{ $siteName }}" class="h-8 w-auto brightness-0 invert opacity-90">
                @else
                    <span class="text-xl font-black text-white tracking-tight">{{ $siteName }}</span>
                @endif
            </div>

            <div class="flex flex-wrap gap-2.5 justify-center">
                @foreach($settings as $key => $url)
                    @if(str_ends_with($key, '_url') && !empty($url))
                        @php $platform = str_replace('_url', '', $key); @endphp

                        <a href="{{ $url }}" target="_blank" rel="noopener noreferrer" title="{{ ucfirst($platform) }}"
                           class="w-8 h-8 rounded-full border border-slate-800 flex items-center justify-center text-slate-400 transition-all duration-300 hover:bg-slate-800 hover:text-white"
                           data-platform="{{ $platform }}">

                            @if($platform === 'facebook')
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                            @elseif($platform === 'instagram')
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r=".6" fill="currentColor"/></svg>
                            @elseif($platform === 'linkedin')
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
                            @elseif(in_array($platform, ['twitter', 'x']))
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                            @elseif($platform === 'tiktok')
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"/></svg>
                            @elseif($platform === 'youtube')
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="18" rx="2" ry="2"/><path d="M10 9l5 3-5 3z"/></svg>
                            @elseif($platform === 'behance')
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 12H3V9h9v3zm0 4H3v-3h9v3zm1-7h8v2h-8V9zm1 4.5c0 1.38 1.12 2.5 2.5 2.5s2.5-1.12 2.5-2.5-1.12-2.5-2.5-2.5-2.5 1.12-2.5 2.5z"/></svg>
                            @elseif($platform === 'pinterest')
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/><circle cx="12" cy="12" r="10"/></svg>
                            @elseif($platform === 'whatsapp')
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
                            @elseif($platform === 'messenger')
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/><path d="M8 14l3-3 2.5 2.5L16 10l-3 3-2.5-2.5L8 14z" fill="currentColor" stroke="none"/></svg>
                            @else
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                            @endif

                        </a>
                    @endif
                @endforeach
            </div>
        </div>

        <div class="flex flex-col sm:flex-row justify-between items-center gap-3 pt-5 text-[11px] text-slate-500">
            <p class="font-medium text-center sm:text-right">{{ $settings['copyright'] ?? 'جميع الحقوق محفوظة © وسم ميديا' }}</p>
            @if(!empty($settings['footer_text']))
                <p class="text-slate-400/80 text-center sm:text-left max-w-md">{{ $settings['footer_text'] }}</p>
            @endif
        </div>

    </div>
</footer>

<script>
  // دالة الفلترة الذكية مع تحديد حد أقصى (3 مشاريع فقط) لأي قسم أو للكل
function filterPortfolio(category, button) {
    // 1. إدارة كلاسات التحديد للأزرار (تلوين الزر النشط وإعادة البقية للرمادي)
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.classList.remove('bg-[#172E66]', 'text-white', 'shadow-sm');
        btn.classList.add('text-slate-600', 'hover:text-[#172E66]');
    });
    
    button.classList.add('bg-[#172E66]', 'text-white', 'shadow-sm');
    button.classList.remove('text-slate-600', 'hover:text-[#172E66]');

    // عداد لحساب عدد المشاريع التي تم إظهارها حالياً
    let shownCount = 0;

    // 2. الفلترة الآمنة والالتزام بـ 3 مشاريع كحد أقصى للـ "الكل" أو "الأقسام"
    document.querySelectorAll('.portfolio-item').forEach(item => {
        const itemCategory = item.getAttribute('data-category');
        
        // هل العنصر يطابق الفئة المحددة؟
        const isMatch = (category === 'all' || itemCategory === category);

        // إذا كان متطابقاً ولم نتجاوز 3 مشاريع، نقوم بإظهاره
        if (isMatch && shownCount < 3) {
            item.style.display = 'block';
            setTimeout(() => item.style.opacity = '1', 50);
            shownCount++; // زيادة العداد
        } else {
            // إخفاء بقية المشاريع الزائدة عن 3
            item.style.opacity = '0';
            item.style.display = 'none';
        }
    });
}

    function reveal() {
        document.querySelectorAll(".reveal").forEach(element => {
            const windowHeight = window.innerHeight;
            const elementTop = element.getBoundingClientRect().top;
            if (elementTop < windowHeight - 80) element.classList.add("active");
        });
    }
    window.addEventListener("scroll", reveal);
    window.addEventListener("DOMContentLoaded", reveal);

    const navLinks = document.querySelectorAll('.nav-link');
    const sections = ['home', 'services', 'portfolio', 'process', 'contact']
        .map(id => document.getElementById(id))
        .filter(Boolean);

    function updateActiveNav() {
        let currentId = sections[0]?.id;
        const scrollPos = window.scrollY + 120;
        sections.forEach(sec => { if (sec.offsetTop <= scrollPos) currentId = sec.id; });
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
            el.addEventListener('input', () => { if (checks[id](el.value)) clearError(id); });
        });

        contactForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            let valid = true;
            Object.keys(checks).forEach(id => {
                const el = document.getElementById(id);
                if (checks[id](el.value)) clearError(id); else { setError(id); valid = false; }
            });
            if (!valid) return;

            const submitBtn = contactForm.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span>جارٍ الإرسال...</span><span class="material-symbols-outlined text-sm animate-spin">progress_activity</span>';

            try {
                const formData = {
                    name: document.getElementById('f-name').value.trim(),
                    company: document.getElementById('f-company').value.trim(),
                    email: document.getElementById('f-email').value.trim(),
                    phone: document.getElementById('f-phone').value.trim(),
                    service: document.getElementById('f-service').value,
                    message: document.getElementById('f-message').value.trim(),
                    _token: document.querySelector('meta[name="csrf-token"]')?.content ?? '',
                };
                const response = await fetch('/contact', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': formData._token },
                    body: JSON.stringify(formData),
                });
                const data = await response.json();
                if (response.ok && data.success) {
                    document.getElementById('formWrap').style.display = 'none';
                    document.getElementById('formSuccess').classList.add('show');
                } else {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                    if (data.errors) {
                        const fieldMap = { name: 'f-name', email: 'f-email', phone: 'f-phone', service: 'f-service' };
                        Object.entries(data.errors).forEach(([field]) => { if (fieldMap[field]) setError(fieldMap[field]); });
                    }
                }
            } catch (err) {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
                alert('حدث خطأ في الاتصال، يرجى المحاولة مجدداً.');
            }
        });
    }

    // تشغيل الفلترة تلقائياً عند تحميل الصفحة ليعرض أحدث 3 مشاريع فقط في البداية
document.addEventListener('DOMContentLoaded', () => {
    const allBtn = document.getElementById('btn-filter-all');
    if (allBtn) {
        filterPortfolio('all', allBtn);
    }
});
</script>

@include('partials.whatsapp')

</body>
</html>
