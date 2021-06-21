@extends('layouts.admin')
@section('content')
<div class="container">
    <h3>Fleet - Edit</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/fleet">Fleets</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-body">
            <form action="/fleet/edit/{{ encrypt($data->id) }}" method="POST"> @csrf
                <div class="row">
                    <div class="col-sm-12 mt-3 col-md-6">
                        <div class="form-group">
                            <label for="name">Name <span class="text-danger"></span></label>
                            <input type="text" class="form-control" required value="{{ old('name')??$data->name }}" name="name" id="name" placeholder="Enter Name">
                            @if($errors->has('name'))
                                <small id="name" class="form-text text-danger">{{ $errors->first('name') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 mt-3 col-md-6">
                        <div class="form-group">
                            <label for="code">Flight Code <span class="text-danger"></span></label>
                            <input type="text" class="form-control" required value="{{ old('code')??$data->code }}" name="code" id="code" placeholder="Enter Flight Code">
                            @if($errors->has('code'))
                                <small id="code" class="form-text text-danger">{{ $errors->first('code') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 mt-3 col-md-6">
                        <div class="form-group">
                            <label for="fid"> Fleet <span class="text-danger"></span></label>
                              <select class="form-control" name="fid" id="fid">
                                    @for($i=0;$i<$fleet->count();$i++)
                                        <option @if($data->fid==$fleet[$i]->id) selected @endif value="{{$fleet[$i]->id}}">{{ $fleet[$i]->name }}</option>
                                    @endfor
                              </select>
                            @if($errors->has('fid'))
                                <small id="fid" class="form-text text-danger">{{ $errors->first('fid') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 mt-3 col-md-6">
                        <div class="form-group">
                            <label for="seats"> Seats <span class="text-danger"></span></label>
                            <input type="text" class="form-control" required value="{{ old('seats')??$data->seats }}" name="seats" id="seats" placeholder="Enter Seats">
                            @if($errors->has('seats'))
                                <small id="seats" class="form-text text-danger">{{ $errors->first('seats') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 mt-3 col-md-6">
                        <div class="form-group">
                            <label for="status"> Status <span class="text-danger"></span></label>
                              <select class="form-control" name="status" id="status">
                                <option @if($data->status==0) selected @endif value="0">Available</option>
                                <option @if($data->status==1) selected @endif value="1">Maintananced</option>
                              </select>
                            @if($errors->has('status'))
                                <small id="status" class="form-text text-danger">{{ $errors->first('status') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 mt-3 col-md-6">
                        <div class="form-group">
                            <label for="curstatus"> Curent Status <span class="text-danger"></span></label>
                              <select class="form-control" name="curstatus" id="curstatus">
                                <option @if($data->curstatus==0) selected @endif value="0">Parked</option>
                                <option @if($data->curstatus==1) selected @endif value="1">Flying</option>
                              </select>
                            @if($errors->has('curstatus'))
                                <small id="curstatus" class="form-text text-danger">{{ $errors->first('curstatus') }}</small>
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
