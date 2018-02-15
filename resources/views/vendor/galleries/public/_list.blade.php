<ul class="list-galleries">
    @foreach ($items as $gallery)
    @include('galleries::public._list-item')
    @endforeach
</ul>
