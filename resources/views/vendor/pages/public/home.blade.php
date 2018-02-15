@extends('pages::public.master')

@section('page')

{{--
    @if($slides = Slides::all() and $slides->count())
        @include('slides::public._slider', ['items' => $slides, 'custom_class' => 'swiper-home'])
    @endif
--}}

    <div class="container">
        {!! $page->present()->body !!}
    </div>

{{--
    @if($latestNews = News::latest(3) and $latestNews->count())
    <section class="news-section">
        <div class="container">
            {!! Blocks::render('news-home') !!}
            @include('news::public._list', ['items' => $latestNews, 'custom_class' => 'news-list-home'])
        </div>
    </section>
    @endif
--}}

    @include('galleries::public._galleries', ['model' => $page, 'custom_class' => 'gallery-home'])


{{--
    @if($incomingEvents = Events::incoming() and $incomingEvents->count())
        <div class="container-events">
            <h3>@lang('db.Incoming events')</h3>
            @include('events::public._list', ['items' => $incomingEvents])
            <a href="{{ route($lang.'.events') }}" class="btn btn-default btn-xs">@lang('db.All events')</a>
        </div>
    @endif
--}}
{{--
    @if($partners = Partners::allBy('homepage', 1) and $partners->count())
        <div class="container-partners">
            <h2><a href="{{ route($lang.'.partners') }}">@lang('db.Partners')</a></h2>
            @include('partners::public._list', ['items' => $partners])
        </div>
    @endif
--}}

@endsection
