@extends('layouts.admin')

@section('content')
<div class="container">
    <a href="{{ url()->previous() }}" class="btn btn-outline-primary float-right"> <i class="fa fa-caret-left" aria-hidden="true"></i> Back</a>
    <h3>Schedules - View</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/schedules">Schedules</a></li>
            <li class="breadcrumb-item active" aria-current="page">View</li>
        </ol>
    </nav>
    <div class="card mt-4 text-dark">
        <div class="card-body">
            <div class="row">
                <div class="col-6 mt-2 col-md-3">
                    Fleet
                </div>
                <div class="col-6 mt-2 col-md-3">
                    {{ $data->Fleet->name}} - {{ $data->Fleet->code}}
                </div>
                <div class="col-6 mt-2 col-md-3">
                    Route
                </div>
                <div class="col-6 mt-2 col-md-3">
                    {{ $data->Route->Fid->code }} - {{ $data->Route->Tid->code }}
                </div>
                <div class="col-6 mt-2 col-md-3">
                    Seats
                </div>
                <div class="col-6 mt-2 col-md-3">
                    {{ $data->seats }}/{{ $data->Fleet->seats}}
                </div>
                <div class="col-6 mt-2 col-md-3">
                    Fare
                </div>
                <div class="col-6 mt-2 col-md-3">
                    <i class="fas fa-rupee-sign    "></i> {{ $data->fare?? '-' }}
                </div>
                <div class="col-6 mt-2 col-md-3">
                    Scheduled
                </div>
                <div class="col-6 mt-2 col-md-3">
                   {{ $data->date }} # {{ $data->time }}
                </div>
                <div class="col-6 mt-2 col-md-3">
                    Landed
                </div>
                <div class="col-6 mt-2 col-md-3">
                   {{ $data->landedDate }} # {{ $data->landedTime }}
                </div>
                <div class="col-6 mt-2 col-md-3">
                    Recieved Amount
                </div>
                <div class="col-6 mt-2 col-md-3">
                  <i class="fas fa-rupee-sign    "></i> {{ $data->recieved }}
                </div>
                <div class="col-6 mt-2 col-md-3">
                    Net Cost
                </div>
                <div class="col-6 mt-2 col-md-3">
                  <i class="fas fa-rupee-sign    "></i> {{ $data->netcost }}
                </div>
                <div class="col-6 mt-2 col-md-3">
                    Status
                </div>
                <div class="col-6 mt-2 col-md-3">
                    @if($data->status==0)
                        Scheduled
                    @elseif($data->status==1) Departed
                    @else
                        Landed
                    @endif
                </div>
                <div class="col-6 mt-2 col-md-3">
                   Schedule Status
                </div>
                <div class="col-6 mt-2 col-md-3">
                    @if($data->sttype==0) On Scheduled
                    @elseif($data->sttype==1) Delayed
                    @else  Early
                    @endif
                </div>


                <div class="col-6 mt-2 col-md-3">
                    Description
                </div>
                <div class="col-6 mt-2 col-md-3">
                  {{ $data->desc }}
                </div>
            </div>
        </div>
        </div>
</div>
@endsection
