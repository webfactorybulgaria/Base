@section('js')
    <script src="{{ asset('components/ckeditor/ckeditor.js') }}"></script>
@endsection

@include('core::admin._buttons-form')

{!! BootForm::hidden('id') !!}

<ul class="nav nav-tabs">
    <li class="@if (Request::input('tab') != 'tab-files')active @endif">
        <a href="#tab-main" data-target="#tab-main" data-toggle="tab">@lang('global.Content')</a>
    </li>
    <li class="@if (Request::input('tab') == 'tab-files')active @endif">
        <a href="#tab-files" data-target="#tab-files" data-toggle="tab">@lang('global.Files')</a>
    </li>
</ul>

<div class="tab-content">

    {{-- Main tab --}}
    <div class="tab-pane fade in @if(Request::input('tab') != 'tab-files')active @endif" id="tab-main">

        @include('core::admin._image-fieldset', ['field' => 'image'])

        {!! BootForm::text(trans('validation.attributes.name'), 'name') !!}

        @include('core::form._title-and-slug')
        {!! TranslatableBootForm::hidden('status')->value(0) !!}
        {!! TranslatableBootForm::checkbox(trans('validation.attributes.online'), 'status') !!}
        {!! TranslatableBootForm::textarea(trans('validation.attributes.summary'), 'summary')->rows(4) !!}
        {!! TranslatableBootForm::textarea(trans('validation.attributes.body'), 'body')->addClass('ckeditor') !!}

    </div>

    {{-- Galleries tab --}}
    <div class="tab-pane fade in @if(Request::input('tab') == 'tab-files')active @endif" id="tab-files">

        @if ($model->id)
            @include('galleries::admin.files')
        @else
            <p class="alert alert-info">@lang('galleries::global.Save your gallery, then add files.')</p>
        @endif

    </div>

</div>
