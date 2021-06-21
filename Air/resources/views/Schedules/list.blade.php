@extends('layouts.admin')

@section('content')
    <div class="container">
        <a href="/schedules/add" class="btn btn-primary float-right"> <i class="fa fa-plus" aria-hidden="true"></i> Add
            Schedules</a>
        <h3>Schedules</h3>
        <div class="card mt-3">
            <div class="card-body">
                <h4><i class="fa fa-filter fa-fw" aria-hidden="true"></i>Filters</h4>
                <form action="/schedules">
                    <div class="row">
                        <div class="col-sm-12 col-md-3 mt-3">
                            <div class="form-group">
                                <label for="fleet">Fleet Name / Code</label>
                                <input value="{{ request()->get('fleet') ?? '' }}" type="text" class="form-control"
                                    name="fleet" id="fleet" placeholder="Enter Fleet Name/Code">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3 mt-3">
                            <div class="form-group">
                                <label for="airport">Airport Name/ Code</label>
                                <input value="{{ request()->get('airport') ?? '' }}" type="text" class="form-control"
                                    name="airport" id="airport" placeholder="Enter Airport Fleet/Code">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3 mt-3">
                            <label for="ordid">Status</label>
                            <select class="custom-select" id="status" name="status">
                                <option @if (request()->get('status') == -1) selected @endif value="-1">Select By Status</option>
                                <option @if (request()->get('status') == 0) selected @endif value="0">Scheduled</option>
                                <option @if (request()->get('status') == 1) selected @endif value="1">Departed</option>
                                <option @if (request()->get('status') == 2) selected @endif value="2">Landed</option>
                            </select>
                        </div>

                        <div class="col-sm-12 col-md-3 mt-3">
                            <label for="ordid">Sort By Id #</label>
                            <select class="custom-select" id="ordid" name="ordid">
                                <option @if (request()->get('ordid') == 0) selected @endif value="0">None</option>
                                <option @if (request()->get('ordid') == 1) selected @endif value="1">Descending</option>
                                <option @if (request()->get('ordid') == 2) selected @endif value="2">Ascending</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                        <a href="/schedules" class="btn btn-outline-dark mr-2">Clear</a>
                        <input type="submit" class="btn btn-outline-primary" value="Filter">
                    </div>
                </form>
            </div>
        </div>
        <div class="card mt-4 text-dark">
            <div class="card-body">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>Flight ID</th>
                            <th>Route</th>
                            <th>Scheduled Depature Time</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($data->count() > 0)
                            @for ($i = 0; $i < $data->count(); $i++)
                                <tr class="align-middle">
                                    <td>
                                        {{ $data[$i]->Fleet->code }}
                                    </td>
                                    <td>
                                        {{ $data[$i]->Route->Fid->code }} - {{ $data[$i]->Route->Tid->code }}
                                    </td>
                                    <td>
                                        {{ $data[$i]->date }}    {{ $data[$i]->time }}
                                    </td>
                                    <td>
                                        @if($data[$i]->status==0)
                                            Scheduled
                                        @elseif($data[$i]->status==1) Departed
                                        @else
                                            Landed
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="/schedules/view/{{ encrypt($data[$i]->id) }}" type="button"
                                                class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            <button id="btnGroupDrop1" type="button"
                                                class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false"></button>
                                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                <a href="/schedules/edit/{{ encrypt($data[$i]->id) }}" type="button"
                                                    class="btn btn-outline-dark dropdown-item"><i class="fa fa-edit"
                                                        aria-hidden="true fa-fw"></i> Edit</a>
                                                <a href="/schedules/delete/{{ encrypt($data[$i]->id) }}" type="button"
                                                    class="btn btn-outline-dark dropdown-item"><i class="fa fa-trash"
                                                        aria-hidden="true fa-fw"></i> Delete</a>
                                            </div>
                                        </div>
                                        <div>
                                    </td>
                                </tr>
                            @endfor
                        @else
                            <tr class="text-center p-3">
                                <td colspan="7" style="font-weight: 500 " class=" p-3 bg-danger text-white">Sorry no data
                                    found.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>

                <div class="d-flex justify-content-end mt-2">
                    {{ $data->appends(['code' => request()->get('code') ?? '', 'name' => request()->get('name') ?? '', 'ordid' => request()->get('ordid') ?? 0])->links() }}
                </div>
            </div>
        </div>
    @endsection
