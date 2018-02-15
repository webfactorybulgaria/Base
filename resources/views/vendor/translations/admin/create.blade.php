@extends('core::admin.master')

@section('title', trans('translations::global.New'))

@section('main')

    @include('core::admin._button-back', ['module' => 'translations'])
    <h1>
        @lang('translations::global.New')
    </h1>

    {!! BootForm::open()->action(route('admin::index-translations'))->multipart()->role('form') !!}
        @include('translations::admin._form')
    {!! BootForm::close() !!}

@endsection
