<ul class="list-jobs">
    @foreach ($items as $job)
    @include('jobs::public._list-item')
    @endforeach
</ul>
