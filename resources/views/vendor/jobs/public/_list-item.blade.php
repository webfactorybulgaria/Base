<li>
    <a href="{{ route($lang.'.jobs.slug', $job->slug) }}" title="{{ $job->title }}">
        {!! $job->title !!}
        {!! $job->present()->thumb(null, 200) !!}
    </a>
</li>
