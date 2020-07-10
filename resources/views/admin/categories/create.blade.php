@extends('layouts.app')

@section('title')
New Category
@endsection

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            New Category
        </div>
        <div class="card-body">
            <form action="{{ route('admin-categories-store') }}" method="POST">
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label font-weight-bold">
                        Category name
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="e.g. Contemporary" required>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <button type="submit" class="btn btn-success mx-auto">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection