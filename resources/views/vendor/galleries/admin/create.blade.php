@extends('core::admin.master')

@section('title', trans('galleries::global.New'))

@section('main')

    @include('core::admin._button-back', ['module' => 'galleries'])
    <h1>
        @lang('galleries::global.New')
    </h1>

    {!! BootForm::open()->action(route('admin::index-galleries'))->multipart()->role('form') !!}
        @include('galleries::admin._form')
    {!! BootForm::close() !!}

@endsection
