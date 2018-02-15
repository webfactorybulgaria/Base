@if ($model->files->count())
    <ul class="gallery-files files-list">
    @foreach ($model->files as $file)
        <li class="files-list-item">
            @if ($file->type == 'i')
            <a class="files-list-image fancybox" href="{!! $file->present()->thumbSrc(1200, 1200, array('resize'), 'file') !!}" data-fancybox-group="{{ $model->slug }}" title="{{ $file->alt_attribute }}" data-descr="{{ $file->description }}">
                <img class="files-list-image-thumb" src="{!! $file->present()->thumbSrc(650, 350, array(), 'file') !!}" alt="{{ $file->alt_attribute }}">
                <div class="files-list-descr">
                    <h4>{{ $file->present()->alt_attribute }}</h4>
                    <p>{{ $file->present()->description }}</p>
                </div>
            </a>
            @else
            <a class="files-list-document" href="{{ asset($file->path.'/'.$file->file) }}" target="_blank">
                <span class="files-list-document-icon fa fa-file-o fa-3x"></span>
                <span class="files-list-document-filename">{{ $file->file }}</span> <small class="files-list-document-filesize">({{ $file->present()->filesize }})</small>
            </a>
            @endif
        </li>
    @endforeach
    </ul>
@endif
