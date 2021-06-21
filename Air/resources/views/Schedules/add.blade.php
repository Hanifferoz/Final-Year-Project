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
            <form action="/schedules/add" method="POST"> @csrf
                <div class="row">

                    <div class="col-sm-12 mt-3 col-md-6">
                        <div class="form-group">
                            <label for="fid"> Flight ID <span class="text-danger"></span></label>
                              <select class="form-control" name="fid" id="fid">
                                    @for($i=0;$i<$fleet->count();$i++)
                                        <option @if(old('fid')==$fleet[$i]->id) selected @endif value="{{ $fleet[$i]->id }}">{{ $fleet[$i]->name }}</option>
                                    @endfor
                              </select>
                            @if($errors->has('fid'))
                                <small id="fid" class="form-text text-danger">{{ $errors->first('fid') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 mt-3 col-md-6">
                        <div class="form-group">
                            <label for="rid"> Routes <span class="text-danger"></span></label>
                              <select class="form-control" name="rid" id="rid">
                                    @for($i=0;$i<$routes->count();$i++)
                                        <option @if(old('rid')==$routes[$i]->id) selected @endif value="{{ $routes[$i]->id }}">{{ $routes[$i]->Fid->code }} - {{ $routes[$i]->Tid->code }}</option>
                                    @endfor
                              </select>
                            @if($errors->has('rid'))
                                <small id="rid" class="form-text text-danger">{{ $errors->first('rid') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 mt-3 col-md-6">
                        <div class="form-group">
                            <label for="fare"> Fare <span class="text-danger"></span></label>
                            <input type="text" class="form-control" required value="{{ old('fare') }}" name="fare" id="fare" placeholder="Enter Fare">
                            @if($errors->has('fare'))
                                <small id="fare" class="form-text text-danger">{{ $errors->first('fare') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 mt-3 col-md-6">
                        <div class="form-group">
                            <label for="time"> Scheduled Time <span class="text-danger"></span></label>
                            <input type="time" class="form-control" required value="{{ old('time') }}" name="time" id="time" placeholder="Enter Scheduled Time">
                            @if($errors->has('time'))
                                <small id="time" class="form-text text-danger">{{ $errors->first('time') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 mt-3 col-md-6">
                        <div class="form-group">
                            <label for="date"> Scheduled Date <span class="text-danger"></span></label>
                            <input type="date" class="form-control" min="{{ date('Y-m-d') }}" required value="{{ old('date') }}" name="date" id="date" placeholder="Enter Scheduled Date">
                            @if($errors->has('date'))
                                <small id="time" class="form-text text-danger">{{ $errors->first('date') }}</small>
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
