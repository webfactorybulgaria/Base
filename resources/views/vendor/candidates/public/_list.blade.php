<ul class="list-candidates">
    @foreach ($items as $candidate)
    @include('candidates::public._list-item')
    @endforeach
</ul>
