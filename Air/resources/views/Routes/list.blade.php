@extends('layouts.admin')

@section('content')
    <div class="container">
        <a href="/routes/add" class="btn btn-primary float-right"> <i class="fa fa-plus" aria-hidden="true"></i> Add
            Routes</a>
        <h3>Routes</h3>
        <div class="card mt-4 text-dark">
            <div class="card-body">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>Routes Name</th>
                            <th>Routes Code</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($data->count() > 0)
                            @for ($i = 0; $i < $data->count(); $i++)
                                <tr class="align-middle">
                                    <td>
                                        {{ $data[$i]->Fid->name }} - {{ $data[$i]->Tid->name }}
                                    </td>
                                    <td>
                                        {{ $data[$i]->Fid->code }} - {{ $data[$i]->Tid->code }}
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="/routes/view/{{ encrypt($data[$i]->id) }}" type="button"
                                                class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            <button id="btnGroupDrop1" type="button"
                                                class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false"></button>
                                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                <a href="/routes/edit/{{ encrypt($data[$i]->id) }}" type="button"
                                                    class="btn btn-outline-dark dropdown-item"><i class="fa fa-edit"
                                                        aria-hidden="true fa-fw"></i> Edit</a>
                                                <a href="/routes/delete/{{ encrypt($data[$i]->id) }}" type="button"
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
