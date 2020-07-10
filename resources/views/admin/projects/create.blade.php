@extends('layouts.app')

@section('title')
New Project
@endsection

@section('head')
<script src="https://cdn.tiny.cloud/1/ki6agi5l9838uye4vcvrjeaujmdbx77zqqastubfn0xxifu8/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea',
        plugins: ["image", "lists"],
        toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
        fullpage_default_font_family: "'Times New Roman', Georgia, Serif;",
    });
</script>
@endsection

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            New Project
        </div>
        <div class="card-body">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            <form action="{{ route('admin-projects-store', $galleryID) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="projectName" class="col-sm-2 col-form-label font-weight-bold">
                        Project name
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" name="name" id="projectName" placeholder="e.g. Awesome Project" required>
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="date" class="col-sm-2 col-form-label font-weight-bold">
                        Project Date
                    </label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control @error('date') is-invalid @enderror" name="date" id="date" value="{{ old('date') }}">
                        @error('date')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="location" class="col-sm-2 col-form-label font-weight-bold">
                        Project Location
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('location') is-invalid @enderror" name="location" id="location" placeholder="e.g. Kathmandu, Nepal" value="{{ old('location') }}">
                        @error('location')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="isEvent" class="col-sm-2 col-form-label font-weight-bold">
                        Choose boi
                    </label>
                    <div class="col-sm-10">

                        <div class="form-check form-check-inline">
                            <input name="news" onclick="toggleNews(this)" class="form-check-input" type="radio" id="Checkbox2" value="false" checked>
                            <label class="form-check-label" for="Checkbox2">Project/Event</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="news" onclick="toggleNews(this)" class="form-check-input" type="radio" id="Checkbox1" value="true">
                            <label class="form-check-label" for="Checkbox1">News&Media</label>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="category" class="col-sm-2 col-form-label font-weight-bold">
                        Project Category
                    </label>
                    <div class="col-sm-10">
                        <select id="category" name="category" class="form-control media-class @error('category') is-invalid @enderror" required>
                            <option selected>Select Category</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="project-year" class="col-sm-2 col-form-label font-weight-bold">
                        Project Year
                    </label>
                    <div class="col-sm-10">
                        <select id="project-year" name="project-year" class="form-control media-class @error('project-year') is-invalid @enderror" required>
                            <option selected>Select Year</option>
                            @foreach($years as $year)
                            <option value="{{ $year->id }}">{{ $year->year }}</option>
                            @endforeach
                        </select>
                        @error('project-year')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>


                <div class="form-group row">
                    <label for="isEvent" class="col-sm-2 col-form-label font-weight-bold">
                        Is this an event?
                    </label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline">
                            <input name="event" onclick="toggleEvent(this)" class="media-class form-check-input" type="radio" id="inlineCheckbox1" value="yes">
                            <label class="form-check-label" for="inlineCheckbox1">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="event" onclick="toggleEvent(this)" class="media-class form-check-input" type="radio" id="inlineCheckbox2" value="no" checked>
                            <label class="form-check-label" for="inlineCheckbox2">No</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="event-photo" class="col-sm-2 col-form-label font-weight-bold">
                        Event Photo
                    </label>
                    <div class="input-group col-sm-10">
                        <div class="custom-file @error('event-photo') is-invalid @enderror">
                            <input name="event-photo" onchange="eventImagechanged(this)" type="file" class="custom-file-input event-class" id="inputGroupFile03" aria-describedby="inputGroupFileAddon03" required aria-required="true" disabled>
                            <label id="eventFileLabel" class="custom-file-label" for="inputGroupFile03">Choose file</label>
                        </div>
                        @error('event-photo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="event-location" class="col-sm-2 col-form-label font-weight-bold">
                        Event Location
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control event-class @error('event-location') is-invalid @enderror" name="event-location" id="event-location" placeholder="e.g. Kathmandu, Nepal" disabled>
                        @error('event-location')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="event-start-date" class="col-sm-2 col-form-label font-weight-bold">
                        Event Start Date
                    </label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control event-class @error('event-start-date') is-invalide @enderror" name="event-start-date" id="event-start-date" disabled>
                        @error('event-start-date')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="event-end-date" class="col-sm-2 col-form-label font-weight-bold">
                        Event End Date
                    </label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control event-class @error('event-end-date') is-invalide @enderror" name="event-end-date" id="event-end-date" disabled>
                        @error('event-end-date')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="event-start-time" class="col-sm-2 col-form-label font-weight-bold">
                        Event Start Time
                    </label>
                    <div class="col-sm-10">
                        <input type="time" class="form-control  event-class @error('event-start-time') is-invalide @enderror" name="event-start-time" id="event-start-time" placeholder="e.g. 12:00 pm" disabled>
                        @error('event-start-time')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="event-end-time" class="col-sm-2 col-form-label font-weight-bold">
                        Event End Time
                    </label>
                    <div class="col-sm-10">
                        <input type="time" class="form-control event-class @error('event-end-time') is-invalid @enderror" name="event-end-time" id="event-end-time" placeholder="e.g. 12:00 pm" disabled>
                        @error('event-end-time')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="featured" class="col-sm-2 col-form-label font-weight-bold">
                        Featured Image
                    </label>
                    <div class="input-group col-sm-10">
                        <div class="custom-file @error('featured') is-invalid @enderror">
                            <input name="featured" onchange="changed(this)" type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" required aria-required="true">
                            <label id="fileLabel" class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                        @error('featured')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="gallery" class="col-sm-2 col-form-label font-weight-bold">
                        Gallery Images*
                    </label>
                    <div class="input-group col-sm-10">
                        <div class="custom-file">
                            <input multiple name="gallery" onchange="uploadGalleryImages(this)" type="file" class="custom-file-input" id="inputGroupFile02" aria-describedby="inputGroupFileAddon02">
                            <label id="fileLabel2" class="custom-file-label" for="inputGroupFile02">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col col-form-label">
                        *Note: Gallery images can be used later for inline images in the blog. You need to upload these images before it can be used in the blog.
                    </label>
                </div>
                <div class="form-group row">
                    <label class="col col-form-label">
                        All the gallery images will be displayed here! Click on the image to copy the image url. Right click to delete an image.
                    </label><br>
                </div>
                <div id="gallery" class="form-group row">
                </div>
                <div class="form-group">
                    <textarea name="blog" id="" cols="30" rows="20">{{ old('blog') }}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function changed(e) {
        var fileName = document.getElementById("inputGroupFile01").files[0].name;
        console.log(fileName);
        var nextSibling = document.getElementById("fileLabel");
        nextSibling.innerText = fileName;
    }

    function eventImagechanged(e) {
        var fileName = document.getElementById("inputGroupFile03").files[0].name;
        console.log(fileName);
        var nextSibling = document.getElementById("eventFileLabel");
        nextSibling.innerText = fileName;
    }

    function toggleEvent(e) {
        var enable;
        if (e.value == "yes")
            enable = true;
        else
            enable = false;
        var elements = document.getElementsByClassName("event-class");
        for (i = 0; i < elements.length; i++) {
            elements[i].disabled = !enable;
        }
    }

    function toggleNews(f) {
        if (f.value == "true")
            enable = false;
        else
            enable = true;
        var elements = document.getElementsByClassName("media-class");
        for (i = 0; i < elements.length; i++) {
            elements[i].disabled = !enable;
        }
        var enabled;
        if (f.value == 'true') {
            enabled = false;
            var medias = document.getElementsByClassName('event-class');
            for (i = 0; i < medias.length; i++) {
                medias[i].disabled = !enabled
            }
        }
    }

    function uploadGalleryImages(e) {
        var galleryEl = document.getElementById("gallery");
        galleryEl.innerHTML = '\
        <div class="container">\
            <b>Uploading please wait ... </b>\
            <div class="spinner-grow text-primary" role="status">\
                <span class="sr-only">Loading...</span>\
            </div>\
            <div class="spinner-grow text-secondary" role="status">\
                <span class="sr-only">Loading...</span>\
            </div>\
            <div class="spinner-grow text-success" role="status">\
                <span class="sr-only">Loading...</span>\
            </div>\
            <div class="spinner-grow text-danger" role="status">\
                <span class="sr-only">Loading...</span>\
            </div>\
            <div class="spinner-grow text-warning" role="status">\
                <span class="sr-only">Loading...</span>\
            </div>\
            <div class="spinner-grow text-info" role="status">\
                <span class="sr-only">Loading...</span>\
            </div>\
        </div>';
        var files = e.files;
        var formData = new FormData();
        for (i = 0; i < files.length; i++) {
            formData.append('photos[]', files[i]);
        }
        fetch("{{ route('admin-project-gallery-upload', $galleryID) }}", {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            body: formData,
        }).then((response) => {
            response.text().then((data) => {
                galleryEl.innerHTML = data;
            });
        });
    }

    function deletePhoto(id) {
        var galleryEl = document.getElementById("gallery");
        galleryEl.innerHTML = '\
        <div class="container">\
            <b>Deleting please wait ... </b>\
            <div class="spinner-grow text-primary" role="status">\
                <span class="sr-only">Loading...</span>\
            </div>\
            <div class="spinner-grow text-secondary" role="status">\
                <span class="sr-only">Loading...</span>\
            </div>\
            <div class="spinner-grow text-success" role="status">\
                <span class="sr-only">Loading...</span>\
            </div>\
            <div class="spinner-grow text-danger" role="status">\
                <span class="sr-only">Loading...</span>\
            </div>\
            <div class="spinner-grow text-warning" role="status">\
                <span class="sr-only">Loading...</span>\
            </div>\
            <div class="spinner-grow text-info" role="status">\
                <span class="sr-only">Loading...</span>\
            </div>\
        </div>';
        var formData = new FormData();
        formData.append('photo', id);
        fetch("{{ route('admin-project-photo-delete') }}", {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            body: formData,
        }).then((response) => {
            response.text().then((data) => {
                galleryEl.innerHTML = data;
            });
        });
        toastr.success("Image deleted!");
    }

    function copyURL(e) {
        console.log(e.src);
        navigator.clipboard.writeText(e.src);
        toastr.success("Copied to clipboard.");
    }
</script>
@endsection