@extends('layouts.artree')

@section('title')
Projects | {{ $year->year }}
@endsection

@section('body')
<div class="container">
    <div class="page">
        @if($year->projects->count() == 0 || $year->projects()->where('hidden', false)->get()->count() == 0)
            <h1>Projects from the Future</h1><br>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <img class="card-img-top cardImg" src="{{ asset('images/eye.png') }}" alt="Card image">
                        <div class="card-body">
                            <p class="card-title">
                                <i class="fal fa-calendar"></i>&nbsp; 
                                {{ Carbon\Carbon::now()->format('l jS \\of F Y') }}
                            </p>
                            <p class="card-text">
                                <strong>Could not find projects</strong> <br>
                                ... We could not find any projects for this year ...
                            </p>
                            <a href="#" class="btn btn-artee">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <h1>Projects from {{ $year->year }}</h1><br>
            <div class="row">
                @foreach($year->projects()->where('hidden', false)->orderBy('project_date', 'asc')->get() as $project)
                    <div class="col-md-4">
                        <div class="card" style="height: 100%;">
                            <img class="card-img-top cardImg" src="{{ $project->featured }}" alt="Card image">
                            <div class="card-body">
                                <p class="card-title">
                                    <i class="fal fa-calendar"></i>&nbsp; 
                                    {{ Carbon\Carbon::parse($project->project_date)->format('l jS \\of F Y') }}
                                </p>
                                <p class="card-text">
                                    <strong>{{ $project->name }}</strong> <br>
                                    ... {{ substr(strip_tags($project->body), 10, 150) }} ...
                                </p>
                                <a href="{{ route('projects-read', ['year' => $year->year, 'project' => $project]) }}" class="btn btn-artee">Read More</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

@endsection