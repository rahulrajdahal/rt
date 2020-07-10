@extends('layouts.artree')

@section('title')
About Us
@endsection

@section('body')
<div class="container">
    <div class="page">
        <div class="row">
            <div class="col-md-8">
                <div class="aboutHead">
                    <h1>About us</h1>
                </div>
            </div>
            <div class="col-md-4">
                <div class="aboutTagline">
                    <i class="fas fa-quote-left"></i>
                    <p>
                        {{ $settings->tagline ?? 'No taglines found' }} 
                    </p>
                </div>
            </div>
        </div>
        <br>
        <p class="text-justify">
            {!! nl2br($settings->about ?? 'About us is empty ...') !!}
        </p>
        <br><br>
        @include('layouts.partials.team')
    </div>
</div>

@endsection