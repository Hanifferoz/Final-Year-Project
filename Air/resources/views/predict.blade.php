@extends('layouts.admin')

@section('content')
    <div class="container">
        <h3>Routes Predict</h3>
        <div class="card mt-4 text-dark">
            <div class="card-body">
                <form action="/predict" method="post">@csrf
                    <div class="row">
                        <div class="col-sm-12 col-md-6 mt-2">
                            <div class="form-group">
                              <label for="">From Airport</label>
                              <select class="form-control" name="fid" id="">
                                @for($i=0;$i<$airport->count();$i++)
                                    <option value="{{ $airport[$i]->id }}">{{ $airport[$i]->name }} - {{ $airport[$i]->code }}</option>
                                @endfor
                              </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 mt-2">
                            <div class="form-group">
                              <label for="">To Airport</label>
                              <select class="form-control" name="tid" id="">
                                @for($i=0;$i<$airport->count();$i++)
                                    <option value="{{ $airport[$i]->id }}">{{ $airport[$i]->name }} - {{ $airport[$i]->code }}</option>
                                @endfor
                              </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 mt-2">
                            <div class="form-group">
                              <label for="">Date</label>
                              <input type="date"
                                class="form-control" name="date" id="" min="{{ date('Y-m-d') }}"  placeholder="">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 mt-2">
                            <div class="form-group">
                              <label for="">Distance</label>
                              <input type="text"
                                class="form-control" name="distance" id="" aria-describedby="helpId" placeholder="Enter Distance">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 mt-2">
                            <div class="form-group">
                              <label for="">Fuel Cost</label>
                              <input type="text"
                                class="form-control" name="fuelcost" id="" aria-describedby="helpId" placeholder="Enter Fuel Cost">
                            </div>
                        </div>

                    </div>
                    <div class="d-flex flex-row-reverse">
                        <input type="submit" class="btn btn-outline-dark" value="Submit">
                    </div>

                </form>
            </div>
        </div>
    @endsection
