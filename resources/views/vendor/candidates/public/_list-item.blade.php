<li>
    <a href="{{ route($lang.'.candidates.slug', $candidate->slug) }}" title="{{ $candidate->title }}">
        {!! $candidate->title !!}
        {!! $candidate->present()->thumb(null, 200) !!}
    </a>
</li>
