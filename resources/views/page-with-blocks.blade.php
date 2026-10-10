@extends('layouts.app')

@section('title', $page->meta_title ?: $page->title)
@section('description', $page->meta_description)

@section('content')
    <div class="page legal-page">
        <h1 class="legal-page__title">{{ $page->title }}</h1>
        <div class="legal-page__body">
            @if ($blocks->isNotEmpty())
                <x-content-blocks :blocks="$blocks" type="1" />
            @elseif ($page->link === 'about-us')
                <section class="cblock"><h2>The road to Vice City. Together.</h2><p>GTA VI News is an independent publication for players who want to keep up with the next chapter of Grand Theft Auto. We follow the official announcements, explore the world of Leonida, and take a closer look at the details.</p><p>We're fans of the game and curious about the stories behind it. We're not affiliated with Rockstar Games or Take-Two Interactive.</p><h2>Got something to share?</h2><p>Send a tip, suggest a correction, or say hello through our <a href="{{ route('contact-us') }}">contact page</a>.</p></section>
            @elseif ($page->link === 'review-policy')
                <section class="cblock"><h2>Follow the facts.</h2><p>Our coverage starts with primary sources. We link to official announcements and distinguish confirmed details from speculation. Game artwork and screenshots are credited to their original creators.</p><h2>Keep the record straight.</h2><p>Found an error? <a href="{{ route('contact-us') }}">Let us know</a> so the publication can review it.</p></section>
            @else
                <p>This page's content has not been published yet. For questions, <a href="{{ route('contact-us') }}">contact the publication</a>.</p>
            @endif
        </div>
    </div>
@endsection
