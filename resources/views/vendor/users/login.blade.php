@extends('core::admin.master')

@section('title', trans('users::global.Log in'))

@section('page-header')
@endsection
@section('sidebar')
@endsection
@section('mainClass')
@endsection
@section('errors')
@endsection

@section('main')

<div id="login" class="container-login container-xs-center">

{!! BootForm::open() !!}

    <h1>@lang('users::global.Log in')</h1>

    @include('users::_form-login')

    @if (config()->get('auth.social_users'))
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <a href="{{ route('social.redirect', ['provider' => 'google']) }}" class="btn btn-lg waves-effect waves-light btn-block google">Google+</a>
        </div>
    </div>
    @endif

{!! BootForm::close() !!}

</div>

@endsection
