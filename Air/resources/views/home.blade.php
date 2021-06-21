@extends('layouts.admin')

@section('content')
    <div class="container-fluid bg-white p-3" style="border-radius:20px">
        <div class="dropdown float-right">
            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                View By
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="/home?type=0">This Day</a>
                <a class="dropdown-item" href="/home?type=1">This Week</a>
                <a class="dropdown-item" href="/home?type=2">This Month</a>
            </div>
        </div>
        <h3 class="mx-5">Hi , Good
            @if (date('H') < 12) Morning
        @elseif(date('H')>=12 && date('H') <15) Afternoon @else Evening @endif
    </h3>
    <h5 class="text-center">
        @if (Request::get('type') == 1)
            Week - {{ date('W') }}
        @elseif (Request::get('type') == 2)
            Month - {{ date('M') }}
        @elseif (Request::get('type') == 3)
            Year - {{ date('Y') }}
        @else
            Date : {{ date('d-m-Y') }}
        @endif
    </h5>
    <div class="row justify-contents-center align-items-center">
        <div class="col-sm-12 col-md-8 mt-2">
            <div class="card">
                <div class="card-body">
                    <h4>Airports</h4>
                    <airportchart :gndcost="{{ $airport->pluck('gndcost') }}" :cities="{{ $airport->pluck('name') }}"></airportchart>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4 mt-2">
            <div class="card">
                <div class="card-body">
                    <h4>Today Scheduled Flight - {{ $todaySchedult }}</h4>
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-body">
                    <h4>Today Flights - {{ $tf }}</h4>
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-body">
                    <h4>Flight Status</h4>
                    <flightstatus :staus="{{ $flight->pluck('total') }}"></flightstatus>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-3">
        <linechartdata :data="{{ json_encode($netcost??[0]) }}" :datax="{{ json_encode($recieved??[0]) }}"></linechartdata>
    </div>
</div>
@endsection
