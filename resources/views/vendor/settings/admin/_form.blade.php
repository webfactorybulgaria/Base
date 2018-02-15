<div class="row">
    <div class="form-group col-sm-12">
        <button class="btn-primary btn" type="submit">@lang('validation.attributes.save')</button>
    </div>
</div>

<label>@lang('validation.attributes.website_title')</label>
@foreach ($locales as $lang)
    <div class="row">
        <div class="col-sm-9 form-group">
            <div class="input-group">
                <span class="input-group-addon">{{ strtoupper($lang) }}</span>
                <input class="form-control" type="text" name="{{ $lang }}[website_title]" value="@if(isset($data->$lang)){{ $data->$lang->website_title }}@endif">
            </div>
        </div>
        <div class="col-sm-3 checkbox">
            <label>
                <input type="hidden" name="{{ $lang }}[status]" value="0">
                <input type="checkbox" name="{{ $lang }}[status]" value="1" @if(isset($data->$lang) and $data->$lang->status)checked @endif> @lang('validation.attributes.online')
            </label>
        </div>
    </div>
@endforeach

<div class="fieldset-media fieldset-image">
    {!! BootForm::hidden('image') !!}
    @if(isset($data->image) and $data->image)
    <div class="fieldset-preview">
        <img class="img-responsive" src="/uploads/settings/{{ $data->image }}" alt="" width="150">
        <small class="text-danger delete-attachment" data-table="settings" data-id="" data-field="image">Supprimer</small>
    </div>
    @endif
    <div class="fieldset-field">
        {!! BootForm::file(trans('validation.attributes.logo'), 'image') !!}
    </div>
</div>

{!! BootForm::email(trans('validation.attributes.webmaster_email'), 'webmaster_email') !!}
@if (! config('typicms.welcome_message_url'))
    {!! BootForm::textarea(trans('validation.attributes.welcome_message'), 'welcome_message') !!}
@endif
{!! BootForm::select(trans('validation.attributes.admin_locale'), 'admin_locale', array_combine($admin_locales, $admin_locales)) !!}
{!! BootForm::text(trans('validation.attributes.google_analytics_code'), 'google_analytics_code') !!}
{!! BootForm::hidden('lang_chooser')->value(0) !!}
@if (config('typicms.main_locale_in_url'))
    {!! BootForm::checkbox(trans('validation.attributes.lang_chooser'), 'lang_chooser') !!}
@endif
{!! BootForm::hidden('auth_public')->value(0) !!}
{!! BootForm::checkbox(trans('validation.attributes.auth_public'), 'auth_public') !!}
{!! BootForm::hidden('register')->value(0) !!}
{!! BootForm::checkbox(trans('validation.attributes.registration allowed'), 'register') !!}
