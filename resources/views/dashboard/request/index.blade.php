@extends('dashboard.layouts.core')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Pending Requests</h1>
    </div>

    <div class="col-md-6 mt-4">
        @if (session()->has("success"))
            <div class="alert alert-success col-md-6" role="alert">
                {{ session("success") }}
            </div>
        @endif
        @if (session()->has("failed"))
            <div class="alert alert-danger col-md-6" role="alert">
                {{ session("failed") }}
            </div>
        @endif
        @foreach ($loans as $l)  
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p class="m-0">{{ $l->user->name }} at {{ $l->created_at }}</p>
                    @if($l->acceptance_status === 1)
                        <h5><span class="badge bg-opacity-25 bg-success text-success">Accepted</span></h5>
                    @elseif($l->acceptance_status === 0)
                        <h5><span class="badge bg-opacity-25 bg-danger text-danger">Rejected</span></h5>
                    @else
                        <h5><span class="badge bg-opacity-100 bg-warning text-white">Waiting</span></h5>
                    @endif
                </div>
                <div class="card-body">
                    <h5 class="card-title mb-3">{{ $l->book->title }}</h5>
                    <p class="card-text"><strong>Student ID : </strong>{{ $l->studentId }}</p>
                    <p class="card-text d-inline"><strong>Message :</strong> {!! $l->body !!}</p>
                    @if($l->acceptance_status === NULL)
                        <a href="/dashboard/requests/{{ $l->id }}/accept" class="btn btn-success">Accept</a>
                        <a href="/dashboard/requests/{{ $l->id }}/reject" class="btn btn-danger">Reject</a>
                    @else
                        <a href="/dashboard/requests/{{ $l->id }}/cancel" class="btn btn-danger" onclick="return confirm('Are you sure want to cancel ?');">Cancel</a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection