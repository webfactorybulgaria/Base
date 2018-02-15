@include('core::admin._message', ['closable' => false])

{!! BootForm::email(trans('validation.attributes.email'), 'email')->addClass('input-lg') !!}
{!! BootForm::text(trans('validation.attributes.first_name'), 'first_name')->addClass('input-lg') !!}
{!! BootForm::text(trans('validation.attributes.last_name'), 'last_name')->addClass('input-lg') !!}
{!! BootForm::password(trans('validation.attributes.password') . (config('auth.optional_password') ? ' (Optional)' : ''), 'password')->addClass('input-lg') !!}

@if (!config('auth.optional_password'))
{!! BootForm::password(trans('validation.attributes.password_confirmation'), 'password_confirmation')->addClass('input-lg') !!}
@endif

<div class="form-group form-action">
    {!! BootForm::submit(trans('validation.attributes.register'), 'btn-primary')->addClass('btn-lg btn-block') !!}
</div>