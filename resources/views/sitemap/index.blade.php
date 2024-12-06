@php
    // $base_url = 'https://www.merisehat.pk';
    $base_url = rtrim(env('APP_URL', 'https://www.merisehat.pk/'), '/');
    $changefreq = 'monthly';
    $priority = '0.5';
@endphp
<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <sitemap>
        <loc>{{$base_url}}</loc>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </sitemap>

    <sitemap>
        <loc>{{$base_url}}/ur</loc>
        <changefreq>daily</changefreq>
        <priority>1</priority>
    </sitemap>
    @foreach ($footers as $footer)
    <sitemap>
        <loc>{{$base_url.'/'.ltrim($footer['link'], '/')}}</loc>
        <changefreq>{{$changefreq}}</changefreq>
        <priority>{{$priority}}</priority>
    </sitemap>
    @endforeach

    @foreach ($articles as $article)
    <sitemap>
        @if($article['language']['id'] != 1)
        <loc>{{$base_url.'/'.$article['language']['slug'].'/article/'.$article['slug']}}</loc>
        @else
        <loc>{{$base_url.'/article/'.$article['slug']}}</loc>
        @endif
        <changefreq>{{$changefreq}}</changefreq>
        <priority>{{$priority}}</priority>
    </sitemap>
    @endforeach

    @foreach ($diseases as $disease)
    <sitemap>
        @if($disease['language']['id'] != 1)
        <loc>{{$base_url.'/'.$disease['language']['slug'].'/disease/'.$disease['slug']}}</loc>
        @else
        <loc>{{$base_url.'/disease/'.$disease['slug']}}</loc>
        @endif
        <changefreq>{{$changefreq}}</changefreq>
        <priority>{{$priority}}</priority>
    </sitemap>
    @endforeach
    

    @foreach ($drugs as $drug)
    <sitemap>
        @if($drug['language']['id'] != 1)
        <loc>{{$base_url.'/'.$drug['language']['slug'].'/drug/'.$drug['slug']}}</loc>
        @else
        <loc>{{$base_url.'/drug/'.$drug['slug']}}</loc>
        @endif
        <changefreq>{{$changefreq}}</changefreq>
        <priority>{{$priority}}</priority>
    </sitemap>
    @endforeach

</sitemapindex>
