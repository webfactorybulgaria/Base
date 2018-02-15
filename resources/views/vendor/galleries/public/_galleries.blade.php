@foreach ($model->galleries as $gallery)
    @if($gallery->status)
    <section class="gallery{{ (!empty($custom_class)) ? ' '.$custom_class : '' }}">
        @if($gallery->title)
        <h3 class="gallery-title">{{ $gallery->title }}</h3>
        @endif
        {!! $gallery->present()->body !!}
        @include('galleries::public._thumbs', ['model' => $gallery])
    </section>
    @endif
@endforeach
