@extends('layouts.app')

@section('title')
Add Team Member
@endsection

@section('content')
<div class="container">
    <div class="card">
        <form action="{{ route('admin-team-store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-header">
                Add Team Member
            </div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label font-weight-bold">
                        Photo
                    </label>
                    <div class="col-sm-10">
                        <div class="custom-file @error('photo') is-invalid @enderror">
                            <input name="photo" onchange="changed(this)" type="file" class="custom-file-input" id="inputGroupFile01"
                            aria-describedby="inputGroupFileAddon01" required>
                            <label id="fileLabel" class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                        @error('photo')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label font-weight-bold">
                        Name
                    </label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="e.g. Clark Kent" required>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone" class="col-sm-2 col-form-label font-weight-bold">
                        Phone
                    </label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ @old('phone') }}" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="e.g. +977 1234567890">
                        @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone" class="col-sm-2 col-form-label font-weight-bold">
                        Email
                    </label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="e.g. artreenepal@gmail.com" required>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label font-weight-bold">
                        Facebook
                    </label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ old('facebook') }}" class="form-control @error('facebook') is-invalid @enderror" name="facebook" id="facebook" placeholder="e.g. URL">
                        @error('facebook')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="instagram" class="col-sm-2 col-form-label font-weight-bold">
                        Instagram
                    </label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ old('instagram') }}" class="form-control @error('instagram') is-invalid @enderror" name="instagram" id="instagram" placeholder="e.g. URL">
                        @error('instagram')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="instagram" class="col-sm-2 col-form-label font-weight-bold">
                        YouTube
                    </label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ old('youtube') }}" class="form-control @error('youtube') is-invalid @enderror" name="youtube" id="youtube" placeholder="e.g. URL">
                        @error('youtube')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="instagram" class="col-sm-2 col-form-label font-weight-bold">
                        Twitter
                    </label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ old('twitter') }}" class="form-control @error('twitter') is-invalid @enderror" name="twitter" id="twitter" placeholder="e.g. URL">
                        @error('twitter')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="about" class="col-sm-2 col-form-label font-weight-bold">
                        Bio
                    </label>
                    <div class="col-sm-10">
                        <textarea rows="15" cols="100" class="form-control @error('bio') is-invalid @enderror" name="bio" id="bio" placeholder="e.g. It's me Mario." required>{{ old('bio') }}</textarea>
                        @error('bio')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success">Save</button>
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