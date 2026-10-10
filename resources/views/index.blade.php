@extends('layouts.app')

@section('title', 'GTA VI News — Your Vice City Connection')
@section('description', 'Your independent GTA VI news destination. Follow the latest stories, trailers, characters and the world of Vice City and Leonida.')
@section('meta-image', asset('images/gta-vi/vice-city.jpg'))

@php
    $latestStories = $col1Posts->merge($col2Posts)->merge($col3Posts)->unique('id')->sortByDesc('published_at')->values();
    $leadStory = $latestStories->first();
@endphp

@section('content')
    <div class="home-page">
        <section class="hero" aria-labelledby="hero-title">
            <img class="hero-image" src="{{ asset('images/gta-vi/vice-city.jpg') }}" alt="The palm-lined skyline and waterfront of Vice City in Grand Theft Auto VI" fetchpriority="high">
            <div class="hero-shade"></div>
            <div class="hero-inner">
                <p class="eyebrow"><span class="status-dot"></span> INDEPENDENT NEWS. UNLIMITED OBSESSION.</p>
                <h1 id="hero-title">ALL ROADS LEAD<br>TO <span>VICE CITY.</span></h1>
                <p class="hero-description">Every story. Every detail. Every sunset.<br>Your connection to the world of Grand Theft Auto VI.</p>
                <a class="button button--pink" href="#latest">Explore the latest <span aria-hidden="true">↘</span></a>
                <div class="hero-bottom"><span>VICE CITY, LEONIDA</span><span>26° N &nbsp; / &nbsp; 80° W</span><span>THE NEXT CHAPTER STARTS HERE <span aria-hidden="true">↓</span></span></div>
            </div>
            <span class="hero-edition" aria-hidden="true">VI<span>THE LEONIDA EDITION</span></span>
        </section>

        @if ($leadStory)
            <a class="news-ticker" href="{{ route('posts.show', $leadStory) }}"><span class="ticker-label"><span class="status-dot"></span> ON THE RADAR</span><span class="ticker-title">{{ $leadStory->title }}</span><span class="ticker-arrow" aria-hidden="true">↗</span></a>
        @endif

        <section class="news-section page" id="latest" aria-labelledby="latest-title">
            <div class="section-heading"><div><p class="eyebrow">STRAIGHT FROM THE FEED</p><h2 id="latest-title">THE LATEST <span>DISPATCH.</span></h2></div><a class="text-link" href="{{ route('categories.show', $newsCategory) }}">All news <span aria-hidden="true">↗</span></a></div>
            <nav class="tag-filter-row" aria-label="Browse news topics">
                <a class="tag-filter active" href="{{ route('categories.show', $newsCategory) }}">All stories</a>
                @foreach ($topTags->take(5) as $tag)
                    <a class="tag-filter" href="{{ route('categories.show.tag', ['category' => $newsCategory->slug, 'tagSlug' => $tag->slug]) }}">{{ $tag->name }}</a>
                @endforeach
            </nav>
            <div class="news-layout">
                <div class="home-stories posts-grid">
                    <x-post-cards :posts="$latestStories" />
                </div>
                <aside class="news-sidebar" aria-label="Around Leonida">
                    <div class="sidebar-heading"><span class="status-dot"></span> TUNED IN TO LEONIDA</div>
                    <a class="trailer-card" href="https://www.rockstargames.com/VI/media"><div class="trailer-image"><img src="{{ asset('images/gta-vi/trailer-2.jpg') }}" alt="Jason and Lucia in the official GTA VI Trailer 2" loading="lazy"><span class="play-icon" aria-hidden="true">▶</span></div><div class="trailer-body"><span class="eyebrow">THE OFFICIAL FOOTAGE</span><h3>WELCOME TO<br>THE GOOD LIFE.</h3><span class="text-link">Watch Rockstar's trailers <span aria-hidden="true">↗</span></span></div></a>
                    <div class="community-note"><span class="eyebrow">NOISE OFF. SIGNAL ON.</span><h3>A LITTLE LESS RUMOR.<br>A LOT MORE VICE.</h3><p>Official announcements, a closer look at Leonida, and the details that matter.</p><a class="text-link" href="{{ route('about-us') }}">Meet the publication <span aria-hidden="true">↗</span></a></div>
                    @if($topTags->isNotEmpty())
                        <div class="trending-topics"><h3 class="section-label">On everyone's radar</h3>@foreach ($topTags->take(8) as $tag)<a href="{{ route('categories.show.tag', ['category' => $newsCategory->slug, 'tagSlug' => $tag->slug]) }}"><span># {{ $tag->name }}</span><span aria-hidden="true">↗</span></a>@endforeach</div>
                    @endif
                </aside>
            </div>
            @if (config('app.digest_testing') && $digests->isNotEmpty())
                <section class="digest-section"><h2 class="section-label">The digest</h2><div class="posts-grid"><x-post-cards :posts="$digests" /></div></section>
            @endif
        </section>
        <section class="world-section page" id="world" aria-labelledby="world-title"><a class="world-card" href="https://www.rockstargames.com/VI/only-in-leonida"><img src="{{ asset('images/gta-vi/key-art.jpg') }}" alt="Official Grand Theft Auto VI artwork" loading="lazy"><div class="world-content"><p class="eyebrow">BEYOND THE HEADLINES</p><h2 id="world-title">ONE STATE.<br><span>ENDLESS STORIES.</span></h2><p>Meet the people. Explore the places.<br>Get to know the world of Leonida.</p><span class="button button--outline">Explore Rockstar's Leonida <span aria-hidden="true">↗</span></span></div></a></section>
    </div>
@endsection
