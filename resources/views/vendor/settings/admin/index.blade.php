@extends('core::admin.master')

@section('title', trans('global.Settings'))

@section('main')

<h1>@lang('global.Settings')</h1>

<div class="row">

    <div class="col-sm-6">

    {!! BootForm::open()->multipart() !!}
    {!! BootForm::bind($data) !!}

        @include('settings::admin._form')

    {!! BootForm::close() !!}

    </div>

    <div class="col-sm-6">

        <div class="btn-group" role="group" aria-label="System functions">
            @if (config('typicms.cache'))
                <a href="{{ route('admin::clear-cache') }}" class="btn btn-default"><span class="fa fa-trash-o"></span> {{ trans('settings::global.Clear cache') }}</a>
            @endif
            <a href="{{ route('admin::artisan-configCache') }}" class="btn btn-default"><span class="fa fa-bolt"></span> {{ trans('settings::global.Cache config') }}</a>
            <a href="{{ route('admin::artisan-dbMigrate') }}" class="btn btn-default"><span class="fa fa-database"></span> {{ trans('settings::global.Migrate database') }}</a>
        </div>

        <table class="table table-condensed">
            <thead>
                <tr><th colspan="2">@lang('settings::global.System info')</th></tr>
            </thead>
            <tbody>
                <tr>
                    <td class="col-sm-6">@lang('settings::global.Environment')</td>
                    <td class="col-sm-6"><b>{{ App::environment() }}</b></td>
                </tr>
                <tr>
                    <td>@lang('settings::global.System locales')</td>
                    <td>
                        <div class="container-system-locales">
                            <b><?php try { system('locale -a'); } catch (Exception $e) { echo $e->getMessage(); } ?></b>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>@lang('settings::global.Active locale')</td>
                    <td><b>{{ config('app.locale') }}</b></td>
                </tr>
                <tr>
                    <td>@lang('settings::global.Cache')</td>
                    <td><b><?php echo config('typicms.cache') ? trans('settings::global.Yes') : trans('settings::global.No') ; ?></b></td>
                </tr>
            </tbody>
        </table>

    </div>

</div>

@endsection
