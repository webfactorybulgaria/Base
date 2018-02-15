@extends('core::admin.master')

@section('title', trans('menus::global.New'))

@section('main')

    @include('core::admin._button-back', ['module' => 'menus'])
    <h1>
        @lang('menus::global.New')
    </h1>

    {!! BootForm::open()->action(route('admin::index-menus'))->multipart()->role('form') !!}
        @include('menus::admin._form')
    {!! BootForm::close() !!}

@endsection
