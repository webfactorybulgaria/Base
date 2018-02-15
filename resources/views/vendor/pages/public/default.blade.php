@extends('pages::public.master')

@section('page')

    @if($children)
    <ul class="nav nav-subpages">
        @foreach ($children as $child)
        @include('pages::public._listItem', array('child' => $child))
        @endforeach
    </ul>
    @endif
    <div class="container">
        {!! $page->present()->body !!}

        @include('galleries::public._galleries', ['model' => $page])
    </div>

@endsection
