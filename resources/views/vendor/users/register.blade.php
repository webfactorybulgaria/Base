@extends('core::admin.master')

@section('title', trans('users::global.Register'))

@section('page-header')
@endsection
@section('sidebar')
@endsection
@section('mainClass')
@endsection
@section('errors')
@endsection

@section('main')

<div id="register" class="container-register container-xs-center">


    {!! BootForm::open() !!}
        <h1>@lang('users::global.Register')</h1>

        @include('users::_form-register')

    {!! BootForm::close() !!}

</div>

@endsection
