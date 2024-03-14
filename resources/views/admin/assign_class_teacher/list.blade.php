@extends('layouts.app')

@section('title', 'Assign Class Teacher')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Assign Class Teacher (Total Record: {{ $getRecord->total() }})</h1>
                </div>
                <div class="col-sm-6">
                    <a href="{{ url('admin/assign_class_teacher/add') }}" class="btn btn-primary btn-sm" style="float: inline-end;"><i class="fa fa-plus" aria-hidden="true"></i> Add</a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Search Assign Class Teacher</h3>
                        </div>
                        <form action="" method="get">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label>Class Name</label>
                                        <input type="text" class="form-control" placeholder="Name" name="class_name" value="{{ Request::get('class_name') }}">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>Teacher Name</label>
                                        <input type="text" class="form-control" placeholder="Name" name="teacher_name" value="{{ Request::get('teacher_name') }}">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="">Select Status</option>
                                            <option {{ (Request::get('status') == 100) ? 'selected' : '' }} value="100">Active</option>
                                            <option {{ (Request::get('status') == 1) ? 'selected' : '' }} value="1">Inactive</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>Date</label>
                                        <input type="date" class="form-control" name="date" value="{{ Request::get('date') }}">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <button class="btn btn-primary btn-sm" type="submit" style="margin-top: 34px;">Search</button>
                                        <a href="{{ url('admin/assign_class_teacher/list') }}" class="btn btn-success btn-sm" type="submit" style="margin-top: 34px;">Clear</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    @include('message')

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Assign Class Teacher List</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Class Name</th>
                                        <th>Teacher Name</th>
                                        <th>Status</th>
                                        <th>Created By</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($getRecord as $data)
                                    <tr>
                                        <td>{{ $data->id }}</td>
                                        <td>{{ $data->class_name }}</td>
                                        <td>{{ $data->teacher_name }} {{ $data->teacher_last_name}}</td>
                                        <td>
                                            @if ($data->status == 0)
                                            <span class="badge badge-success">Active</span>
                                            @elseif ($data->status == 1)
                                            <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>{{ $data->created_by_name }}</td>
                                        <td>{{ date('d-m-Y H:i A', strtotime($data->created_at)) }}</td>
                                        <td>
                                            <a href="{{ url('admin/assign_class_teacher/edit/'.$data->id) }}" class="btn btn-success btn-sm"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit</a>

                                            <a href="{{ url('admin/assign_class_teacher/delete/'.$data->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>

                                            <a href="{{ url('admin/assign_class_teacher/edit_single/'.$data->id) }}" class="btn btn-primary btn-sm">Single Edit</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div style="padding: 10px; float: right;">
                                {{ $getRecord->links() }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection