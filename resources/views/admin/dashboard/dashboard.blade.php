@extends('layouts.app')

@section('title')
Dashboard
@endsection

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Dashboard</div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            Welcome Admin!
        </div>
    </div>
</div>
@endsection