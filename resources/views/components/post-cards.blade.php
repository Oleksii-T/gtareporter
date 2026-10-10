@forelse ($posts as $post)
    @php $thumbnail = $post->thumbnail(); @endphp
    <a class="post-list-card" href="{{ route('posts.show', $post) }}">
        <div class="post-list-card__thumb"><img src="{{ $thumbnail?->url ?: asset('images/gta-vi/vice-city.jpg') }}" alt="{{ $thumbnail?->alt ?: $post->title }}" loading="lazy"><span class="card-arrow" aria-hidden="true">↗</span></div>
        <div class="post-list-card__body">
            <p class="card-kicker">{{ $post->tags->first()?->name ?: 'The dispatch' }} <span aria-hidden="true">/</span> <time datetime="{{ $post->published_at?->toIso8601String() }}">{{ $post->published_at?->format('M d, Y') }}</time></p>
            <h2 class="post-list-card__title">{{ $post->title }}</h2>
            @if ($post->intro)<p class="card-excerpt">{{ Str::limit(strip_tags($post->intro), 125) }}</p>@endif
            <span class="card-read">Read the story <span aria-hidden="true">↗</span></span>
        </div>
    </a>
@empty
    <div class="empty-state"><span class="eyebrow">THE FEED IS QUIET. FOR NOW.</span><h2>Good stories are on the way.</h2><p>Check back for the latest from Vice City and beyond.</p></div>
@endforelse
