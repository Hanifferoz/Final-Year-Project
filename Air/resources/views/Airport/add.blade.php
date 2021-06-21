@extends('layouts.admin')
@section('content')
<div class="container">
    <h3>Airport - Add</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/airport">Airports</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-body">
            <form action="/airport/add" method="POST"> @csrf
                <div class="row">
                    <div class="col-sm-12 mt-3 col-md-6">
                        <div class="form-group">
                            <label for="name">Airport Name <span class="text-danger"></span></label>
                            <input type="text" class="form-control" required value="{{ old('name') }}" name="name" id="name" placeholder="Enter Airport Name">
                            @if($errors->has('name'))
                                <small id="name" class="form-text text-danger">{{ $errors->first('name') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 mt-3 col-md-6">
                        <div class="form-group">
                            <label for="code">Airport Code <span class="text-danger"></span></label>
                            <input type="text" class="form-control" required value="{{ old('code') }}" name="code" id="code" placeholder="Enter Airport Code">
                            @if($errors->has('code'))
                                <small id="code" class="form-text text-danger">{{ $errors->first('code') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 mt-3 col-md-6">
                        <div class="form-group">
                            <label for="city"> City <span class="text-danger"></span></label>
                            <input type="text" class="form-control" required value="{{ old('city') }}" name="city" id="city" placeholder="Enter  City">
                            @if($errors->has('city'))
                                <small id="city" class="form-text text-danger">{{ $errors->first('city') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 mt-3 col-md-6">
                        <div class="form-group">
                            <label for="state"> State <span class="text-danger"></span></label>
                            <input type="text" class="form-control" required value="{{ old('state') }}" name="state" id="state" placeholder="Enter State">
                            @if($errors->has('state'))
                                <small id="state" class="form-text text-danger">{{ $errors->first('state') }}</small>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 mt-3 col-md-6">
                        <div class="form-group">
                            <label for="gndcost">Airport Ground Cost <span class="text-danger"></span></label>
                            <input type="text" class="form-control" required value="{{ old('gndcost') }}" name="gndcost" id="gndcost" placeholder="Enter Airport Ground Cost">
                            @if($errors->has('gndcost'))
                                <small id="gndcost" class="form-text text-danger">{{ $errors->first('gndcost') }}</small>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-row-reverse">
                    <input type="submit" class="btn btn-outline-dark" value="Submit">
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
