<!doctype html>
<html lang="{{ config('app.locale') }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="robots" content="<?= App::environment() == 'production' ? "all" : "noindex, nofollow" ?>" />

    @yield('meta_tags')
    <meta property="og:site_name" content="{{ $websiteTitle }}">
    <meta property="og:title" content="@yield('ogTitle')">
    <meta property="og:description" content="@yield('description')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ URL::full() }}">
    <meta property="og:image" content="@yield('image')">

    <link href="{{ app()->isLocal() ? asset('css/public.css') : asset(elixir('css/public.css')) }}" rel="stylesheet">
    @include('core::public._feed-links')
    @yield('css')
    @if(app()->environment('production') and config('typicms.google_analytics_code'))
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        ga('create', '{{ config('typicms.google_analytics_code') }}', 'auto');
        ga('send', 'pageview');
    </script>
    @endif

</head>

<body class="body-{{ $lang }} @yield('bodyClass') @if($navbar)has-navbar @endif">

    @section('skip-links')
    <a href="#main" class="skip-to-content sr-only">@lang('db.Skip to content')</a>
    @show

    {{-- @include('core::_navbar') --}}

    @section('site-header')
    <header class="header navbar navbar-inverse">
        <div class="container">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false">
                    <span class="sr-only">@lang('db.Toggle navigation')</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                @section('site-title')
                    @include('core::public._site-title')
                @show
            </div>


            @section('lang-switcher')
                @include('core::public._lang-switcher')
            @show

            @section('site-nav')
            <nav class="site-nav navbar-collapse collapse" id="navbar">
                {!! Menus::render('main') !!}
            </nav>
            @show

        </div>
    </header>
    @show

    <main class="main" id="main">
        @include('core::public._alert')
        @yield('main')
    </main>

    @section('site-footer')
    <footer class="footer">
        <div class="container">
            <nav class="footer-nav">
                {!! Menus::render('footer') !!}
            </nav>
            <nav class="social-nav">
                {!! Menus::render('social') !!}
            </nav>
        </div>
        <div class="footer-copy">
            <div class="container">
                <p class="copyright">&copy; {{ date('Y') }} {{ $websiteTitle }}</p>
                <p class="made-by">
                    Made by <a href="http://www.webfactory.bg/en/portfolio.html" title="Webfactory Web Design and Web Development" target="_blank"><img src="/uploads/WF_logo_alt.svg" alt="Webfactory" height="16"></a>
                </p>
            </div>
        </div>
    </footer>
    @show


    @include('core::_javascript')

    <script src="@if(app()->environment('production')){{ asset(elixir('js/public/components.min.js')) }}@else{{ asset('js/public/components.min.js') }}@endif"></script>
    <script src="@if(app()->environment('production')){{ asset(elixir('js/public/master.js')) }}@else{{ asset('js/public/master.js') }}@endif"></script>
    @if (Request::input('preview'))
    <script src="{{ asset('js/public/previewmode.js') }}"></script>
    @endif

    @yield('js')

</body>

</html>
