@extends('core::admin.master')

@section('title', trans('menus::global.New menulink'))

@section('main')

    <a href="{{ route('admin::edit-menu', $menu->id) }}" title="{{ trans('menus::global.Back to menu') }}" class="btn-back">
        <span class="text-muted fa fa-arrow-circle-left"></span><span class="sr-only">{{ trans('menus::global.Back to menu') }}</span>
    </a>
    <h1>
        @lang('menus::global.New menulink')
    </h1>

    {!! BootForm::open()->action(route('admin::index-menulinks', $menu->id))->multipart() !!}
        @include('menus::admin._menulink-form')
    {!! BootForm::close() !!}

@endsection
