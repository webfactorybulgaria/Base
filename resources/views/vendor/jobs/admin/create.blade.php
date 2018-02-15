@extends('core::admin.master')

@section('title', trans('jobs::global.New'))

@section('main')

    @include('core::admin._button-back', ['module' => 'jobs'])
    <h1>
        @lang('jobs::global.New')
    </h1>

    {!! BootForm::open()->action(route('admin::index-jobs'))->multipart()->role('form') !!}
        @include('jobs::admin._form')
    {!! BootForm::close() !!}

@endsection
