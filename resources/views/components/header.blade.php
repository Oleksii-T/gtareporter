<header class="site-header">
    <div class="header-inner">
        <a class="brand" href="{{ route('index') }}" aria-label="GTA VI News home">
            <span class="brand-mark" aria-hidden="true">VI</span>
            <span class="brand-type"><strong>{{ $header?->show('site-name') ?: 'GTA VI NEWS' }}</strong><span>YOUR VICE CITY CONNECTION</span></span>
        </a>
        <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="primary-nav"><span>Menu</span><span class="menu-lines" aria-hidden="true"></span></button>
        <nav class="primary-nav" id="primary-nav" aria-label="Primary navigation">
            <a class="nav-link {{ Route::currentRouteName() == 'index' ? 'active' : '' }}" href="{{ route('index') }}" @if(Route::currentRouteName() == 'index') aria-current="page" @endif>Home</a>
            @foreach ($headerCategories as $cat)
                <a class="nav-link {{ request()->segment(1) == $cat->slug ? 'active' : '' }}" href="{{ route('categories.show', $cat) }}" @if(request()->segment(1) == $cat->slug) aria-current="page" @endif>{{ $cat->slug == 'news' ? 'Latest news' : $cat->name }}</a>
            @endforeach
            <a class="nav-link" href="{{ route('index') }}#world">The world</a>
            <a class="nav-link" href="{{ route('about-us') }}">About us</a>
            <a class="header-cta" href="https://www.rockstargames.com/VI/media">Watch the trailers <span aria-hidden="true">↗</span></a>
        </nav>
    </div>
</header>
