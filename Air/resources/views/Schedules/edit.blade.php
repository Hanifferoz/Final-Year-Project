@extends('layouts.admin')
@section('content')
<div class="container">
    <h3>Schedules - Add</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/schedules">Schedules</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-body">
            <form action="/schedules/edit/{{ encrypt($data->id) }}" method="POST"> @csrf
                <div class="row">
                    <div class="col-sm-12 mt-3 col-md-6">
                        <div class="form-group">
                            <h4>Flight</h4>
                            <h5>{{ $data->Fleet->name }} {{ $data->Fleet->code }}</h5>
                        </div>
                    </div>
                    <div class="col-sm-12 mt-3 col-md-6">
                        <div class="form-group">
                            <h4>Route</h4>
                            <h5>{{ $data->Route->Fid->code }} - {{ $data->Route->Tid->code }}</h5>
                        </div>
                    </div>
                    <div class="col-sm-12 mt-3 col-md-6">
                        <div class="form-group">
                            <h4>Fare</h4>
                            <h5><i class="fas fa-rupee-sign    "></i> {{ $data->fare }}</h5>
                        </div>
                    </div>
                    <div class="col-sm-12 mt-3 col-md-6">
                        <div class="form-group">
                            <h4>Scheduled</h4>
                            <h5>{{ $data->time }} # {{ $data->date }}</h5>
                        </div>
                    </div>
                    <div class="col-sm-12 mt-3 col-md-6">
                        <div class="form-group">
                            <label for="seats"> Seats <span class="text-danger"></span></label>
                            <input type="text" class="form-control"  value="{{ old('seats') }}" name="seats" id="seats" placeholder="Enter Seats">
                            @if($errors->has('seats'))
                                <small id="seats" class="form-text text-danger">{{ $errors->first('seats') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 mt-3 col-md-6">
                        <div class="form-group">
                            <label for="date"> Landed Date <span class="text-danger"></span></label>
                            <input type="date" class="form-control" min="{{ date('Y-m-d',strtotime('-2 day')) }}"  value="{{ old('date')??$data->landedDate }}" name="date" id="date" placeholder="Enter Scheduled Date">
                            @if($errors->has('date'))
                                <small id="time" class="form-text text-danger">{{ $errors->first('date') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 mt-3 col-md-6">
                        <div class="form-group">
                            <label for="time"> Landed Time <span class="text-danger"></span></label>
                            <input type="time" class="form-control"  value="{{ old('time')??$data->landedTime }}" name="time" id="time" placeholder="Enter Scheduled Time">
                            @if($errors->has('time'))
                                <small id="time" class="form-text text-danger">{{ $errors->first('time') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 mt-3 col-md-6">
                        <div class="form-group">
                            <label for="rstatusid"> Status <span class="text-danger"></span></label>
                              <select class="form-control" name="status" id="status">
                                        <option @if($data->status==0) selected @endif value="0">Scheduled</option>
                                        <option @if($data->status==1) selected @endif value="1">Departed</option>
                                        <option @if($data->status==2) selected @endif value="2">Landed</option>
                              </select>
                            @if($errors->has('status'))
                                <small id="status" class="form-text text-danger">{{ $errors->first('status') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 mt-3 col-md-6">
                        <div class="form-group">
                            <label for="sttype">Schedule status<span class="text-danger"></span></label>
                              <select class="form-control" name="sttype" id="status">
                                        <option @if($data->sttype==0) selected @endif value="0">onschedule</option>
                                        <option @if($data->sttype==1) selected @endif value="1">Delayed</option>
                                        <option @if($data->sttype==2) selected @endif value="2">Early</option>
                              </select>
                            @if($errors->has('sttype'))
                                <small id="sttype" class="form-text text-danger">{{ $errors->first('sttype') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 mt-3 col-md-6">
                        <div class="form-group">
                            <label for="recieved"> Money Recieved <span class="text-danger"></span></label>
                            <input type="text" class="form-control"  value="{{ old('recieved')??$data->recieved }}" name="recieved" id="recieved" placeholder="Enter Money Collected ">
                            @if($errors->has('recieved'))
                                <small id="recieved" class="form-text text-danger">{{ $errors->first('recieved') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 mt-3 col-md-6">
                        <div class="form-group">
                            <label for="netcost"> Net Cost <span class="text-danger"></span></label>
                            <input type="text" class="form-control"  value="{{ old('netcost')??$data->netcost }}" name="netcost" id="netcost" placeholder="Enter Net Cost">
                            @if($errors->has('netcost'))
                                <small id="netcost" class="form-text text-danger">{{ $errors->first('netcost') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 mt-3 col-md-6">
                        <div class="form-group">
                            <label for="desc"> Description <span class="text-danger"></span></label>
                            <br>
                            <textarea name="desc" id="" style="width:100%"  rows="5">{{ $data->desc }}</textarea>

                            @if($errors->has('desc'))
                                <small id="desc" class="form-text text-danger">{{ $errors->first('desc') }}</small>
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
