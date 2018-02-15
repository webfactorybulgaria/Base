@extends('core::public.master')

@section('title', trans('users::global.Create Address'))

@section('page-header')
@endsection

@section('sidebar')
@endsection

@section('mainClass')
@endsection

@section('errors')
@endsection

@section('main')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Create address</h1>
                <hr>

                {!! BootForm::open()->action(route('address.store'))->role('form') !!}

                    @include('users::public.address._form_fields')

                {!! BootForm::close() !!}
            </div>
        </div>
    </div>
@endsection
