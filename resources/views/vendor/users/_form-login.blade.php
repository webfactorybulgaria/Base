@include('core::admin._message', ['closable' => false])

<div class="form-group">
    {!! Form::email('email')->addClass('form-control input-lg')->placeholder(trans('validation.attributes.email'))->autofocus(true) !!}
</div>
<div class="form-group">
    {!! Form::password('password')->addClass('form-control input-lg')->placeholder(trans('validation.attributes.password')) !!}
</div>

<div class="form-group">
    {!! BootForm::checkbox(trans('users::global.Remember me'), 'remember') !!}
</div>

<div class="form-group">
    {!! BootForm::submit(trans('validation.attributes.log in'), 'btn-primary')->addClass('btn-lg btn-block') !!}
</div>

<div class="form-group">
    <span class="help-block">
        <a href="{{ route('resetpassword') }}">@lang('users::global.Forgot your password?')</a>
    </span>
</div>
@if (config('typicms.register'))
<div class="form-group">
    <span class="help-block">
        <a href="{{ route('register') }}">@lang('users::global.Not Registered?')</a>
    </span>
</div>
@endif