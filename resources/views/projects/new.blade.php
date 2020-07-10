@extends('layouts.artree') @section('title') Projects |
{{ $new->name }}
@endsection @section('body')
<div class="container">
    <div class="page">
        <div class="blogHeader">
            <h1 class="blogTitle">
                {{ $new->name }}
            </h1>
        </div>
        <div class="blogInfo">
            {{ round(strlen(strip_tags($new->body))/200) }} min read
        </div>
        <br />
        <!-- Carousel -->
        <center>
            <div>
                <div id="demo" class="carousel slide" data-ride="carousel">
                    <!-- The slideshow -->
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ $new->featured ?? asset('images/project.png') }}" class="w-100 img-fluid" style="
                                    object-fit: contain;
                                    height: 600px;
                                    background-color: #ed1848;
                                " />
                        </div>
                        @foreach($new->gallery as $gallery)
                        <div class="carousel-item">
                            <img src="{{ $gallery->path }}" class="w-100 img-fluid" style="
                                    object-fit: contain;
                                    height: 600px;
                                    background-color: #ed1848;
                                " />
                        </div>
                        @endforeach
                    </div>

                    <!-- Left and right controls -->
                    <a class="carousel-control-prev" href="#demo" data-slide="prev">
                        <span class="far fa-arrow-left"></span>
                    </a>
                    <a class="carousel-control-next" href="#demo" data-slide="next">
                        <span class="far fa-arrow-right"></span>
                    </a>
                </div>
                <br />
            </div>
        </center>


        <br /><br />
        <div class="row">
            <div class="col-md-12">
                <div style="text-align: justify;" class="blogText">
                    {!! $new->body !!}
                </div>
            </div>
        </div>
        <hr />
        <br />
        <div style="max-width: 720px; margin-right: auto; margin-left: auto;">
            <h6>
                Share this Article
            </h6>
            <div>
                <i class="fab fa-facebook-f share" style="color: #3b5998;"></i>
                <i class="fab fa-twitter share" style="color: #1da1f2;"></i>
            </div>
        </div>
    </div>
</div>

@endsection