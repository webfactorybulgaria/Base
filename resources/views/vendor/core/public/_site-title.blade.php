<a class="navbar-brand" href="{{ TypiCMS::homeUrl() }}">
    @if (TypiCMS::hasLogo())
        <img src="{{ url('uploads/settings/'.config('typicms.image')) }}" alt="{{ TypiCMS::title() }}">
    @else
        {{ TypiCMS::title() }}
    @endif
</a>
