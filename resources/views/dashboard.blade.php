@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Association Financial Management</h1>
    <div class="row">
        <div class="col-md-4">
            <a href="{{ route('members.index') }}" class="btn btn-primary btn-block">Manage Members</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('contributions.index') }}" class="btn btn-success btn-block">View Contributions</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('loans.index') }}" class="btn btn-warning btn-block">View Loans</a>
        </div>
    </div>
</div>
@endsection
