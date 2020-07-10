@extends('layouts.app')

@section('title')
All Categories
@endsection

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            List of Categories
            &nbsp;
            <a href="{{ route('admin-categories-create') }}" class="badge badge-success">
                Add Category
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
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>
                                <a href="{{ route('admin-categories-edit', $category) }}" class="btn btn-primary">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer justify-content-center">
            <div class="row">
                <div class="col-md-5"></div>
                <div class="col-md-2">
                    {{ $categories->links() }}
                </div>
                <div class="col-md-5"></div>
            </div>
        </div>
    </div>
</div>
@endsection