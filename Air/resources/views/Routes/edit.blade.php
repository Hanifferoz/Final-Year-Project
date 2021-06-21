@extends('layouts.admin')
@section('content')
<div class="container">
    <h3>Routes - Edit</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/routes">Routes</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-body">
            <form action="/routes/edit/{{ encrypt($data->id) }}" method="POST"> @csrf
                <div class="row">
                    <div class="col-sm-12 mt-3 col-md-6">
                        <div class="form-group">
                            <label for="fid"> From Airport <span class="text-danger"></span></label>
                              <select class="form-control" name="fid" id="fid">
                                    @for($i=0;$i<$airport->count();$i++)
                                        <option @if($data->fid==$airport[$i]->id) selected @endif value="{{ $airport[$i]->id }}">{{ $airport[$i]->name }}- {{ $airport[$i]->code }}</option>
                                    @endfor
                              </select>
                            @if($errors->has('fid'))
                                <small id="fid" class="form-text text-danger">{{ $errors->first('fid') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 mt-3 col-md-6">
                        <div class="form-group">
                            <label for="tid"> To Airport <span class="text-danger"></span></label>
                              <select class="form-control" name="tid" id="tid">
                                    @for($i=0;$i<$airport->count();$i++)
                                        <option @if($data->tid==$airport[$i]->id) selected @endif value="{{ $airport[$i]->id }}">{{ $airport[$i]->name }}- {{ $airport[$i]->code }}</option>
                                    @endfor
                              </select>
                            @if($errors->has('tid'))
                                <small id="tid" class="form-text text-danger">{{ $errors->first('tid') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 mt-3 col-md-6">
                        <div class="form-group">
                            <label for="distance"> Distance <span class="text-danger"></span></label>
                            <input type="text" class="form-control" required value="{{ old('distance') ?? $data->distance }}" name="distance" id="distance" placeholder="Enter Distance">
                            @if($errors->has('distance'))
                                <small id="distance" class="form-text text-danger">{{ $errors->first('distance') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 mt-3 col-md-6">
                        <div class="form-group">
                            <label for="netmaincost"> Net Resource Cost <span class="text-danger"></span></label>
                            <input type="text" class="form-control" required value="{{ old('netmaincost') ?? $data->netmaincost }}" name="netmaincost" id="distance" placeholder="Enter Net Resource Cost">
                            @if($errors->has('netmaincost'))
                                <small id="netmaincost" class="form-text text-danger">{{ $errors->first('netmaincost') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 mt-3 col-md-6" >
                        <div class="form-group">
                            <label for="travelcost"> Fuel Cost <span class="text-danger"></span></label>
                            <input type="text" class="form-control" required value="{{ old('travelcost') ?? $data->travelcost ?? 0 }}" name="travelcost" id="travelcost" placeholder="Enter Fuel Cost">
                            @if($errors->has('travelcost'))
                                <small id="travelcost" class="form-text text-danger">{{ $errors->first('travelcost') }}</small>
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
