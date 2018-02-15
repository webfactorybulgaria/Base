@section('titleLeftButton')
    <a href="{{ route('admin::edit-menu', $menu->id) }}" title="{{ trans('menus::global.Back to menu') }}">
        <span class="text-muted fa fa-arrow-circle-left"></span><span class="sr-only">{{ trans('menus::global.Back to menu') }}</span>
    </a>
@endsection

<div class="btn-toolbar">
    <button class="btn btn-primary" value="true" id="exit" name="exit" type="submit">@lang('validation.attributes.save and exit')</button>
    <button class="btn btn-default" type="submit">@lang('validation.attributes.save')</button>
    @include('core::admin._lang-switcher', ['js' => true])
</div>

<div class="row">

    {!! BootForm::hidden('id') !!}
    {!! BootForm::hidden('menu_id')->value($menu->id) !!}
    {!! BootForm::hidden('position') !!}
    {!! BootForm::hidden('parent_id') !!}

    <div class="col-sm-6">
        {!! TranslatableBootForm::text(trans('validation.attributes.title'), 'title') !!}
        {!! TranslatableBootForm::text(trans('validation.attributes.url'), 'url')->placeholder('http://') !!}
        {!! TranslatableBootForm::hidden('status')->value(0) !!}
        {!! TranslatableBootForm::checkbox(trans('validation.attributes.online'), 'status') !!}
    </div>

    <div class="col-sm-6">
        {!! BootForm::select(trans('validation.attributes.page_id'), 'page_id', Pages::allForSelect()) !!}
        {!! BootForm::hidden('has_categories')->value(0) !!}
        {!! BootForm::checkbox(trans('validation.attributes.has_categories'), 'has_categories') !!}
        {!! BootForm::select(trans('validation.attributes.target'), 'target', ['' => trans('menus::global.Active tab'), '_blank' => trans('menus::global.New tab')]) !!}
        {!! BootForm::text(trans('validation.attributes.class'), 'class') !!}
        {!! BootForm::text(trans('validation.attributes.icon_class'), 'icon_class') !!}
    </div>

</div>
