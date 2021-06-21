@extends('layouts.admin')

@section('content')
<div class="container">
    <a href="{{ url()->previous() }}" class="btn btn-outline-primary float-right"> <i class="fa fa-caret-left" aria-hidden="true"></i> Back</a>
    <h3>Routes - View</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/routes">Routes</a></li>
            <li class="breadcrumb-item active" aria-current="page">View</li>
        </ol>
    </nav>
    <div class="card mt-4 text-dark">
        <div class="card-body">
            <div class="row">
                <div class="col-6 mt-2 col-md-3">
                    From Airport
                </div>
                <div class="col-6 mt-2 col-md-3">
                    {{ $data->Fid->name?? '-' }}
                </div>
                <div class="col-6 mt-2 col-md-3">
                    To Airport
                </div>
                <div class="col-6 mt-2 col-md-3">
                    {{ $data->Tid->name?? '-' }}
                </div>
                <div class="col-6 mt-2 col-md-3">
                    Distance
                </div>
                <div class="col-6 mt-2 col-md-3">
                    {{ $data->distance?? '-' }}
                </div>
                <div class="col-6 mt-2 col-md-3">
                    Net Main Cost
                </div>
                <div class="col-6 mt-2 col-md-3">
                    <i class="fas fa-rupee-sign    "></i> {{ $data->netmaincost?? '-' }}
                </div>
                <div class="col-6 mt-2 col-md-3">
                    Travel Cost
                </div>
                <div class="col-6 mt-2 col-md-3">
                   <i class="fas fa-rupee-sign    "></i> {{ $data->travelcost?? '-' }}
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-body">
            <h3>Price Forecast</h3>
            <predprice :data="{{ $prate }}" :date="{{ json_encode($date) }}"></predprice>
        </div>
    </div>
</div>
@endsection
