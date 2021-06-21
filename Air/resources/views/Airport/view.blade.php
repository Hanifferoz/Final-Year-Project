@extends('layouts.admin')

@section('content')
<div class="container">
    <a href="{{ url()->previous() }}" class="btn btn-outline-primary float-right"> <i class="fa fa-caret-left" aria-hidden="true"></i> Back</a>
    <h3>Airport - View</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/airport">Airport</a></li>
            <li class="breadcrumb-item active" aria-current="page">View</li>
        </ol>
    </nav>
    <div class="card mt-4 text-dark">
        <div class="card-body">
            <div class="row">
                <div class="col-6 mt-2 col-md-3">
                    Airport Name
                </div>
                <div class="col-6 mt-2 col-md-3">
                    {{ $data->name?? '-' }}
                </div>
                <div class="col-6 mt-2 col-md-3">
                    Airport Code
                </div>
                <div class="col-6 mt-2 col-md-3">
                    {{ $data->code?? '-' }}
                </div>
                <div class="col-6 mt-2 col-md-3">
                    City
                </div>
                <div class="col-6 mt-2 col-md-3">
                    {{ $data->city?? '-' }}
                </div>
                <div class="col-6 mt-2 col-md-3">
                    State
                </div>
                <div class="col-6 mt-2 col-md-3">
                    {{ $data->state?? '-' }}
                </div>
                <div class="col-6 mt-2 col-md-3">
                    Ground Cost
                </div>
                <div class="col-6 mt-2 col-md-3">
                   <i class="fas fa-rupee-sign    "></i> {{ $data->gndcost?? '-' }}
                </div>
            </div>
        </div>
        </div>
</div>
@endsection
