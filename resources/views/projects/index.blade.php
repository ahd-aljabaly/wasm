<!DOCTYPE html>
<html dir="rtl" lang="ar" class="scroll-smooth">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        $logoValI = $settings['logo'] ?? null;
        $logoUrlI = !empty($logoValI)
            ? ((str_starts_with($logoValI, 'http') || str_starts_with($logoValI, '/')) ? $logoValI : asset('storage/' . $logoValI))
            : asset('images/logo.svg');
        $siteNameI = $settings['site_name'] ?? 'Wasm Media';
        $descI = 'تصفّح كامل أعمال ومشاريع ' . $siteNameI . ' في الهوية البصرية والتسويق والتغليف.';
    @endphp

    <title>أعمالنا | {{ $siteNameI }}</title>
    <meta name="description" content="{{ $descI }}">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ route('projects.index') }}">

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ route('projects.index') }}">
    <meta property="og:title" content="أعمالنا | {{ $siteNameI }}">
    <meta property="og:description" content="{{ $descI }}">
    <meta property="og:image" content="{{ $logoUrlI }}">
    <meta property="og:site_name" content="{{ $siteNameI }}">
    <meta property="og:locale" content="ar_SA">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="أعمالنا | {{ $siteNameI }}">
    <meta name="twitter:description" content="{{ $descI }}">
    <meta name="twitter:image" content="{{ $logoUrlI }}">

    {{-- Favicon --}}
    <link rel="icon" type="image/svg+xml" href="{{ $logoUrlI }}">
    <link rel="alternate icon" href="{{ $logoUrlI }}">
    <link rel="apple-touch-icon" href="{{ $logoUrlI }}">
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#172E66">

   <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

@vite(['resources/css/app.css', 'resources/js/app.js'])

<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

    <style>
        :root { --color-primary: #172E66; --color-secondary: #C5A24A; --color-dark: #0B1633; }
        body { font-family: 'Cairo', sans-serif; background-color: #fdfdfc; }
        .lines-layer {
            background-image: linear-gradient(rgba(23, 46, 102, 0.015) 1px, transparent 1px),
                              linear-gradient(90deg, rgba(23, 46, 102, 0.015) 1px, transparent 1px);
            background-size: 60px 60px;
        }
        .reveal { opacity: 0; transform: translateY(30px); transition: opacity 0.85s cubic-bezier(0.16,1,0.3,1), transform 0.85s cubic-bezier(0.16,1,0.3,1); }
        .reveal.active { opacity: 1; transform: translateY(0); }
        .chip-active { background-color: var(--color-primary) !important; color: #fff !important; border-color: var(--color-primary) !important; }
    </style>
</head>
<body class="text-slate-800 antialiased overflow-x-hidden">

@php
    $logoVal = $settings['logo'] ?? null;
    $logoUrl = !empty($logoVal)
        ? ((str_starts_with($logoVal, 'http') || str_starts_with($logoVal, '/')) ? $logoVal : asset('storage/' . $logoVal))
        : null;
    $siteName = $settings['site_name'] ?? 'Wasm Media';
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
            <a class="text-[#172E66] hover:text-[#C5A24A] pb-1 border-b-2 border-transparent transition-all" href="{{ route('home') }}#home">الرئيسية</a>
            <a class="text-[#172E66] hover:text-[#C5A24A] pb-1 border-b-2 border-transparent transition-all" href="{{ route('home') }}#services">خدماتنا</a>
            <a class="text-[#172E66] hover:text-[#C5A24A] font-bold border-b-2 border-[#C5A24A] pb-1 transition-all" href="{{ route('projects.index') }}">أعمالنا</a>
            <a class="text-[#172E66] hover:text-[#C5A24A] pb-1 border-b-2 border-transparent transition-all" href="{{ route('home') }}#process">منهجيتنا</a>
        </nav>
        <a href="{{ route('home') }}#contact" class="hidden sm:inline-flex bg-[#172E66] text-white text-xs md:text-sm font-bold px-6 py-3 rounded-xl hover:bg-[#0B1633] transition-all shadow-md shadow-blue-900/10">
            اتصل بنا
        </a>
    </div>
</header>

<main class="pt-20">

    <!-- ترويسة الصفحة -->
    <section class="relative overflow-hidden bg-[#FDFDFB] pt-16 pb-12 md:pt-20 md:pb-14">
        <div class="absolute inset-0 w-full h-full opacity-100 lines-layer -z-10"></div>
        <div class="absolute top-10 left-5 w-[400px] h-[400px] bg-[#172E66]/5 rounded-full blur-[120px] -z-10"></div>
        <div class="max-w-[1240px] mx-auto px-6 relative z-10">
            <nav class="flex items-center gap-2 text-xs font-bold text-slate-500 mb-5 reveal" aria-label="مسار التنقل">
                <a href="{{ route('home') }}" class="hover:text-[#172E66] transition-colors">الرئيسية</a>
                <span class="material-symbols-outlined text-sm">chevron_left</span>
                <span class="text-[#172E66]">أعمالنا</span>
            </nav>
            <h1 class="reveal text-3xl md:text-5xl text-[#172E66] font-black leading-[1.25] mb-4">معرض أعمالنا الكامل</h1>
            <p class="reveal text-sm md:text-base text-slate-600 font-medium max-w-2xl">استعرض مشاريعنا وكيف ساعدنا شركاءنا على تحويل أهدافهم إلى قصص نجاح واقعية.</p>

            <!-- فلترة بالخدمة -->
            <div class="flex flex-wrap gap-2 mt-8 reveal">
                <a href="{{ route('projects.index') }}"
                   class="text-xs font-bold px-4 py-2 rounded-lg border border-surface-variant bg-white text-on-surface-variant hover:text-primary transition-all {{ $activeSlug === 'all' ? 'chip-active' : '' }}">الكل</a>
                @foreach($services as $service)
                    <a href="{{ route('projects.index', ['service' => $service->slug]) }}"
                       class="text-xs font-bold px-4 py-2 rounded-lg border border-surface-variant bg-white text-on-surface-variant hover:text-primary transition-all {{ $activeSlug === $service->slug ? 'chip-active' : '' }}">{{ $service->title }}</a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- شبكة المشاريع -->
    <section class="py-12 md:py-16 bg-white">
        <div class="max-w-[1240px] mx-auto px-6">
            @if($projects->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($projects as $project)
                        <a href="{{ route('projects.show', $project->slug) }}" class="reveal block group relative overflow-hidden rounded-2xl bg-primary shadow-sm transition-all duration-500 hover:shadow-xl hover:-translate-y-1.5">
                            <div class="aspect-[4/3] w-full relative grayscale group-hover:grayscale-0 transition-all duration-700 flex items-center justify-center" style="background-color: {{ $project->accent_color ?? '#172E66' }};">
                                @if($project->cover_image)
                                    <img src="{{ $project->cover_image_url }}" alt="{{ $project->title }}" loading="lazy" class="w-full h-full object-cover">
                                @else
                                    <div class="absolute -left-10 -top-10 w-48 h-48 rounded-full border-[16px] border-white/5"></div>
                                    <div class="absolute left-16 bottom-6 w-24 h-24 rounded-full border-[10px] border-secondary/15"></div>
                                @endif
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-primary via-primary/20 to-transparent flex flex-col justify-end p-6">
                                <span class="text-[9px] font-bold text-white bg-secondary px-2.5 py-1 rounded-full w-fit mb-2 truncate max-w-full">{{ $project->category_label }}</span>
                                <h3 class="text-on-primary text-lg mb-1 font-bold line-clamp-1" title="{{ $project->title }}">{{ $project->title }}</h3>
                                <p class="text-secondary-fixed text-xs opacity-90 line-clamp-2">{{ $project->short_description }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div class="mt-12">
                    {{ $projects->links() }}
                </div>
            @else
                <div class="text-center py-20">
                    <span class="material-symbols-outlined text-5xl text-slate-300 mb-4">folder_open</span>
                    <p class="text-slate-500 font-bold">لا توجد مشاريع في هذا التصنيف حالياً.</p>
                    <a href="{{ route('projects.index') }}" class="inline-block mt-4 text-sm font-bold text-[#172E66] hover:text-[#C5A24A]">عرض كل الأعمال</a>
                </div>
            @endif
        </div>
    </section>

</main>

<!-- الفوتر -->
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
    function reveal() {
        document.querySelectorAll('.reveal').forEach(el => {
            if (el.getBoundingClientRect().top < window.innerHeight - 60) el.classList.add('active');
        });
    }
    window.addEventListener('scroll', reveal);
    window.addEventListener('DOMContentLoaded', reveal);
</script>

@include('partials.whatsapp')

</body>
</html>
