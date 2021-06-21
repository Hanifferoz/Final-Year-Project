@extends('layouts.admin')

@section('content')
    <div class="container">
        <a href="/flightgroup/add" class="btn btn-primary float-right"> <i class="fa fa-plus" aria-hidden="true"></i> Add
            Flight Group</a>
        <h3>Flight Group</h3>
        <div class="card mt-3">
            <div class="card-body">
                <h4><i class="fa fa-filter fa-fw" aria-hidden="true"></i>Filters</h4>
                <form action="/flightgroup">
                    <div class="row">
                        <div class="col-sm-12 col-md-3 mt-3">
                            <div class="form-group">
                                <label for="name">Flight Group Name</label>
                                <input value="{{ request()->get('name') ?? '' }}" type="text" class="form-control"
                                    name="name" id="name" placeholder="Enter Flight Group Name">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3 mt-3">
                            <div class="form-group">
                                <label for="code">Flight Group Code</label>
                                <input value="{{ request()->get('code') ?? '' }}" type="text" class="form-control"
                                    name="code" id="code" placeholder="Enter Flight Group Code">
                            </div>
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
                        <a href="/flightgroup" class="btn btn-outline-dark mr-2">Clear</a>
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
                            <th>Flight Group Name</th>
                            <th>Flight Group Code</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($data->count() > 0)
                            @for ($i = 0; $i < $data->count(); $i++)
                                <tr class="align-middle">
                                    <td>
                                        {{ $data[$i]->name }}
                                    </td>
                                    <td>
                                        {{ $data[$i]->code }}
                                    </td>
                                    <td>
                                        <a href="/flightgroup/edit/{{ encrypt($data[$i]->id) }}" type="button"
                                            class="btn btn-outline-primary "><i class="fa fa-edit"
                                                aria-hidden="true fa-fw"></i> Edit</a>
                                        <a href="/flightgroup/delete/{{ encrypt($data[$i]->id) }}" type="button"
                                            class="btn btn-outline-danger "><i class="fa fa-trash"
                                                aria-hidden="true fa-fw"></i> Delete</a>
                                        {{--  <div class="btn-group" role="group">
                                            <a href="/flightgroup/view/{{ encrypt($data[$i]->id) }}" type="button"
                                                class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            <button id="btnGroupDrop1" type="button"
                                                class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false"></button>
                                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">

                                            </div>
                                        </div>  --}}
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
