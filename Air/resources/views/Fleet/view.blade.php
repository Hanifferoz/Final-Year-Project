@extends('layouts.admin')

@section('content')
<div class="container">
    <a href="{{ url()->previous() }}" class="btn btn-outline-primary float-right"> <i class="fa fa-caret-left" aria-hidden="true"></i> Back</a>
    <h3>Fleet - View</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/fleet">Fleet</a></li>
            <li class="breadcrumb-item active" aria-current="page">View</li>
        </ol>
    </nav>
    <div class="card mt-4 text-dark">
        <div class="card-body">
            <div class="row">
                <div class="col-6 mt-2 col-md-3">
                    Flight Name
                </div>
                <div class="col-6 mt-2 col-md-3">
                    {{ $data->name?? '-' }}
                </div>
                <div class="col-6 mt-2 col-md-3">
                    Flight Group
                </div>
                <div class="col-6 mt-2 col-md-3">
                    Name - {{ $data->FlightGroup->name }} <br>
                    Code - {{ $data->FlightGroup->code }}

                </div>
                <div class="col-6 mt-2 col-md-3">
                    Flight Code
                </div>
                <div class="col-6 mt-2 col-md-3">
                    {{ $data->code?? '-' }}
                </div>
                <div class="col-6 mt-2 col-md-3">
                    Seats
                </div>
                <div class="col-6 mt-2 col-md-3">
                    {{ $data->seats?? '-' }}
                </div>
                <div class="col-6 mt-2 col-md-3">
                    Status
                </div>
                <div class="col-6 mt-2 col-md-3">
                    @if($data->status==0)
                        Available
                    @else
                        Maintananced
                    @endif
                </div>
                <div class="col-6 mt-2 col-md-3">
                    Status
                </div>
                <div class="col-6 mt-2 col-md-3">
                    @if($data->curstatus==0)Parked
                    @else Flying
                    @endif
                </div>
            </div>
        </div>
        </div>
</div>
@endsection
