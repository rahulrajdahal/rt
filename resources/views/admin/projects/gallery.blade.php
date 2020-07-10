@foreach($gallery as $photo)
    <div class="col-md-2">
        <img onclick="copyURL(this)" oncontextmenu="deletePhoto('{{ $photo->id }}'); return false;" src="{{ $photo->path }}" class="rounded img-thumbnail" width="100" height="100">
    </div>
@endforeach
