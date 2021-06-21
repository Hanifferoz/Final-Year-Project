@extends('layouts.admin')
@section('content')
<div class="container">
    <h3>Flight Group - Edit</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/flightgroup">Flight Groups</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-body">
            <form action="/flightgroup/edit/{{ encrypt($data->id) }}" method="POST"> @csrf
                <div class="row">
                    <div class="col-sm-12 mt-3 col-md-6">
                        <div class="form-group">
                            <label for="name">Flight Group Name <span class="text-danger"></span></label>
                            <input type="text" class="form-control" required value="{{ old('name')??$data->name }}" name="name" id="name" placeholder="Enter Flight Group Name">
                            @if($errors->has('name'))
                                <small id="name" class="form-text text-danger">{{ $errors->first('name') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 mt-3 col-md-6">
                        <div class="form-group">
                            <label for="code">Flight Group Code <span class="text-danger"></span></label>
                            <input type="text" class="form-control" required value="{{ old('code')??$data->codew }}" name="code" id="code" placeholder="Enter Flight Group Code">
                            @if($errors->has('code'))
                                <small id="code" class="form-text text-danger">{{ $errors->first('code') }}</small>
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
