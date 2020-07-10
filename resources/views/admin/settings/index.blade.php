@extends('layouts.app')

@section('title')
Artree Settings
@endsection

@section('content')
<div class="container">
    <div class="card">
        <form action="{{ route('admin-settings-store') }}" method="POST" enctype="multipart/form-data">
            <div class="card-header">
                Page Settings
            </div>
            <div class="card-body">
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label font-weight-bold">
                        Organization Name
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="e.g. Artree Nepal" value="{{ $settings->name ?? '' }}" required>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label font-weight-bold">
                        Logo
                    </label>
                    <div class="col-sm-10">
                        <div class="custom-file @error('logo') is-invalid @enderror">
                            <input name="logo" onchange="changed(this)" type="file" class="custom-file-input" id="inputGroupFile01"
                            aria-describedby="inputGroupFileAddon01">
                            <label id="fileLabel" class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                        @error('logo')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label font-weight-bold">
                        Location
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('location') is-invalid @enderror" name="location" id="location" placeholder="e.g. Kathmandu, Nepal" value="{{ $settings->location ?? '' }}" required>
                        @error('location')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label font-weight-bold">
                        Email
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="e.g. artreenepal@gmail.com" value="{{ $settings->email ?? '' }}" required>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label font-weight-bold">
                        Phone
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="e.g. +977 1234567890" value="{{ $settings->phone ?? '' }}" required>
                        @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label font-weight-bold">
                        Tag Line
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('tag-line') is-invalid @enderror" name="tag-line" id="tag-line" placeholder="e.g. ArtTree projects explore a multitude of identities, cultures, and dynamics with strategic grassroots interventions and a goal of shaping emerging communities." value="{{ $settings->tagline ?? '' }}" required>
                        @error('tag-line')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="about" class="col-sm-2 col-form-label font-weight-bold">
                        About Us
                    </label>
                    <div class="col-sm-10">
                        <textarea rows="15" cols="100" class="form-control @error('about-us') is-invalid @enderror" name="about-us" id="about-us" placeholder="e.g. We are awesome!" required>{{ $settings->about ?? '' }}</textarea>
                        @error('about-us')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="facebook" class="col-sm-2 col-form-label font-weight-bold">
                        Facebook
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('facebook') is-invalid @enderror" name="facebook" id="facebook" placeholder="e.g. https://www.facebook.com/Artree-Nepal-295759690592034/" value="{{ $settings->facebook ?? '' }}">
                        @error('facebook')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label font-weight-bold">
                        Instagram
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('instagram') is-invalid @enderror" name="instagram" id="instagram" placeholder="e.g. url" value="{{ $settings->instagram ?? '' }}">
                        @error('instagram')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label font-weight-bold">
                        YouTube
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('youtube') is-invalid @enderror" name="youtube" id="youtube" placeholder="e.g. url" value="{{ $settings->youtube ?? '' }}">
                        @error('youtube')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label font-weight-bold">
                        Twitter
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('twitter') is-invalid @enderror" name="twitter" id="twitter" placeholder="e.g. url" value="{{ $settings->twitter ?? '' }}">
                        @error('twitter')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success" type="submit">
                    Save
                </button>
            </div>
        </form>
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
</script>
@endsection