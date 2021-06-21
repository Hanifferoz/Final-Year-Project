@extends('layouts.admin')

@section('content')
<div class="container">
    {{--  <a href="{{ url()->previous() }}" class="btn btn-outline-primary float-right"> <i class="fa fa-caret-left" aria-hidden="true"></i> Back</a>  --}}
    <h3>Predict</h3>
    {{--  <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/routes">Routes</a></li>
            <li class="breadcrumb-item active" aria-current="page">View</li>
        </ol>
    </nav>  --}}
    <div class="card mt-4 text-dark">
        <div class="card-body">
            <div class="row">
                <div class="col-6 mt-2 col-md-3">
                    From Airport
                </div>
                <div class="col-6 mt-2 col-md-3">
                    {{ $from->name?? '-' }}
                </div>
                <div class="col-6 mt-2 col-md-3">
                    To Airport
                </div>
                <div class="col-6 mt-2 col-md-3">
                    {{ $to->name?? '-' }}
                </div>
                <div class="col-6 mt-2 col-md-3">
                    Distance
                </div>
                <div class="col-6 mt-2 col-md-3">
                    {{ $distance?? '-' }}
                </div>
                <div class="col-6 mt-2 col-md-3">
                    Fuel Cost
                </div>
                <div class="col-6 mt-2 col-md-3">
                    <i class="fas fa-rupee-sign    "></i> {{ $fuelcost?? '-' }}
                </div>
                <div class="col-6 mt-2 col-md-3">
                    Ground Cost
                </div>
                <div class="col-6 mt-2 col-md-3">
                   <i class="fas fa-rupee-sign    "></i> {{ $from->gndcost+$to->gndcost?? '-' }}
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-body">
            <h3>Price Forecast</h3>
            <predprice :data="{{ json_encode($prate) }}" :date="{{ json_encode($date) }}"></predprice>
        </div>
    </div>
</div>
@endsection
