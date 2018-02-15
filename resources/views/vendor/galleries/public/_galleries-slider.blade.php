@foreach ($model->galleries as $gallery)
    @if($gallery->title)
    <h3>{{ $gallery->title }}</h3>
    @endif
    {!! $gallery->present()->body !!}
    @include('galleries::public._slider', ['model' => $gallery])
@endforeach
