@extends('core::admin.master')

@section('title', trans('dashboard::global.name'))

@section('h1') @endsection

@section('main')

<div class="row">

    <div class="col-sm-12">

        <div class="panel panel-default">

            <div class="panel-heading">
                <h2 class="panel-title">@lang('dashboard::global.Welcome, :name!', array('name' => auth()->user()->first_name))</h2>
            </div>

            <div class="panel-body">
                {!! $welcomeMessage !!}
            </div>

        </div>

        @can('index-history')
        @include('history::admin.latest')
        @endcan

    </div>

</div>

@endsection
