@extends('layouts.app')

@section('title')
All Projects
@endsection

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            List of Projects
            &nbsp;
            <a href="{{ route('admin-projects-create') }}" class="badge badge-success">
                Add Project
            </a>
        </div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Date</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($projects as $project)
                        <tr>
                            <td>{{ $project->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($project->project_date)->toFormattedDateString() }}</td>
                            <td>
                                <a href="{{ route('admin-projects-edit', $project) }}" class="btn btn-primary">Edit</a>
                                @if(!$project->hidden)
                                    <a href="{{ route('admin-projects-hide', $project) }}" class="btn btn-secondary">Hide</a>
                                @else
                                    <a href="{{ route('admin-projects-unhide', $project) }}" class="btn btn-success">Publish</a>
                                @endif    
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $projects->links() }}
        </div>
    </div>
</div>
@endsection