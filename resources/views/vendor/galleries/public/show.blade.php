@extends('core::public.master')

@section('title', $model->title.' – '.trans('galleries::global.name').' – '.$websiteTitle)
@section('ogTitle', $model->title)
@section('description', $model->summary)
@section('image', $model->present()->thumbUrl())
@section('bodyClass', 'body-galleries body-gallery-'.$model->id.' body-page body-page-'.$page->id)

@section('main')

    @include('core::public._btn-prev-next', ['module' => 'Galleries', 'model' => $model])

    @include('galleries::public._slider')

    <article>
        <h1>{{ $model->title }}</h1>
        <p class="summary">{{ nl2br($model->summary) }}</p>
        <div class="body">{!! $model->present()->body !!}</div>
    </article>

    @include('galleries::public._thumbs')

@endsection
