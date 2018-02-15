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

                {!! BootForm::open()->method('POST')->action(route('address.update', $address->id))->role('form') !!}

                {!! BootForm::bind($address) !!}

                {!! method_field('PUT') !!}

                    @include('users::public.address._form_fields')

                {!! BootForm::close() !!}
            </div>
        </div>
    </div>
@endsection
