@extends('layouts.app')

@section('title')
    Team
@endsection

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            Team Member 
            &nbsp; 
            <a href="{{ route('admin-team-create') }}" class="badge badge-success">
                Add new Team member
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
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($team as $member)
                        <tr>
                            <td>
                                <img src="{{ $member->photo }}" style="object-fit:cover;" width="50" height="50">
                            </td>
                            <td>
                                {{ $member->name }}
                            </td>
                            <td>
                                <a href="{{ route('admin-team-edit', $member) }}" class="btn btn-primary">Edit</a>
                                @if($member->hidden)
                                    <a href="{{ route('admin-team-publish', $member) }}" class="btn btn-success">Publish</a>
                                @else
                                    <a href="{{ route('admin-team-hide', $member) }}" class="btn btn-secondary">Hide</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
