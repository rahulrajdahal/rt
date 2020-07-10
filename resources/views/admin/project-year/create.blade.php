@extends('layouts.app')

@section('title')
New Project Year
@endsection

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            New Project Year
        </div>
        <div class="card-body">
            <form action="{{ route('admin-project-years-store') }}" method="POST">
                @csrf
                <div class="form-group row">
                    <label for="year" class="col-sm-2 col-form-label font-weight-bold">
                        Project Year
                    </label>
                    <div class="col-sm-10">
                        <input type="number" min="2000" class="form-control {{ $errors->any()? 'is-invalid': '' }}" name="year" id="year" placeholder="e.g. 2019" value="{{ old('year') }}" required>
                        @error('year')
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