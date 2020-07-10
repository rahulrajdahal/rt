@extends('layouts.artree')

@section('title')
Projects | {{ $project->projectYear->year }} | {{ $project->name }}
@endsection

@section('body')
<div class="container">
    <div class="page">
        <div class="row">
            <div class="col-md-4">
                <div>
                    <h1 class="blogTitle">{{ $project->name }} - {{ $project->projectYear->year }}</h1>
                    <table class="table table-borderless table-sm arteeTable">
                        <tr>
                            <td><i class="fal fa-calendar"></i>&nbsp;</td>
                            <td class="someSpace">
                                {{ Carbon\Carbon::parse($project->project_date)->format('l jS \\of F Y') }}
                            </td>
                        </tr>
                        <tr>
                            <td><i class="fal fa-map-marker"></i>&nbsp;</td>
                            <td class="someSpace">{{ $project->location }}</td>
                        </tr>
                        <tr>
                            <td><div class="fal fa-eye"></div>&nbsp;</td>
                            <td class="someSpace">{{ round(strlen(strip_tags($project->body))/200) }} min read</td>
                        </tr>
                    </table><br>
                    <!--<div class="aboutTagline">
                        <i class="fas fa-quote-left"></i>
                        <p>
                            "Although throughout the history, Nepal 's one of the best exports have been garments and textiles , general Nepali people started to loose their connection with it." 
                        </p>
                    </div>-->
                    <div class="blogBookmark">
                        <h6>Like what you see?</h6>
                        <div>
                            <i class="fal fa-bookmark share"></i>
                            <i class="fab fa-twitter share"></i>
                            <i class="fab fa-facebook share"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div>
                    <div id="demo" class="carousel slide arteeCaro" data-ride="carousel">       
                        <!-- The slideshow -->
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ $project->featured ?? asset('images/project.png') }}" class="d-block w-100 img-fluid">
                            </div>
                            @foreach($project->gallery as $gallery)
                                <div class="carousel-item">
                                    <img src="{{ $gallery->path }}" class="d-block w-100 img-fluid">
                                </div>
                            @endforeach
                        </div>
                        
                        <!-- Left and right controls -->
                        <a class="carousel-control-prev" href="#demo" data-slide="prev">
                            <span class="fal fa-arrow-left"></span>
                        </a>
                        <a class="carousel-control-next" href="#demo" data-slide="next">
                            <span class="fal fa-arrow-right"></span>
                        </a>
                    </div><br>
                </div>
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="col-md-4">
                
            </div>
            <div class="col-md-8">
                <div style="text-align:justify">
                    {!! $project->body !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection