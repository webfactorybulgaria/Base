@if (count($versions = History::versions($model, Config::get('typicms.version_count'))) >= 1)
    <div class="btn-group pull-right">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span id="active-version">{{$versions[0]->created_at}}</span> <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            @foreach ($versions as $key => $version)
                <li><a class="@if(isset($js) and $js)btn-version-js @endif @if(!$key)active @endif" href="" data-json="{{ $version->historable_json }}">{{ $version->created_at }}</a></li>
            @endforeach
        </ul>
    </div>
@endif
