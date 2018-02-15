@extends('core::admin.master')

@section('title', trans('candidates::global.New'))

@section('main')

    @include('core::admin._button-back', ['module' => 'candidates'])
    <h1>
        @lang('candidates::global.New')
    </h1>

    {!! BootForm::open()->action(route('admin::index-candidates'))->multipart()->role('form') !!}
        @include('candidates::admin._form')
    {!! BootForm::close() !!}

@endsection
