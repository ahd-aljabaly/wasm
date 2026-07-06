<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    {{-- الصفحة الرئيسية --}}
    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
    </url>

    {{-- صفحة الأعمال الكاملة --}}
    <url>
        <loc>{{ route('projects.index') }}</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>

    {{-- صفحات المشاريع الفردية --}}
@foreach(($projects ?? []) as $project)
    <url>
        <loc>{{ route('projects.show', $project->slug) }}</loc>
        <lastmod>{{ optional($project->updated_at)->format('Y-m-d') ?? now()->format('Y-m-d') }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
@endforeach
</urlset>
