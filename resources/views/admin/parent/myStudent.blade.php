@extends('layouts.app')

@section('title', 'Parent Student List')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Parent Student List (Total Record: {{ $getParent->name }} {{ $getParent->last_name }})</h1>
                </div>
                <div class="col-sm-6">
                    <a href="{{ url('admin/parent/list') }}" class="btn btn-primary btn-sm" style="float: inline-end;"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
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
                            <h3 class="card-title">Search Student</h3>
                        </div>
                        <form action="" method="get">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label>Student ID</label>
                                        <input type="text" class="form-control" placeholder="Student ID" name="id" value="{{ Request::get('id') }}">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Name</label>
                                        <input type="text" class="form-control" placeholder="Name" name="name" value="{{ Request::get('name') }}">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control" placeholder="Last Name" name="last_name" value="{{ Request::get('last_name') }}">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Email address</label>
                                        <input type="text" class="form-control" placeholder="Email address" name="email" value="{{ Request::get('email') }}">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <button class="btn btn-primary btn-sm" type="submit" style="margin-top: 34px;">Search</button>
                                        <a href="{{ url('admin/parent/my_student/'.$parent_id) }}" class="btn btn-success btn-sm" type="submit" style="margin-top: 34px;">Clear</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    @include('message')

                    @if(!empty($getSearchStudent))
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Student List</h3>
                        </div>
                        <div class="card-body p-0" style="overflow: auto;">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Profile</th>
                                        <th>Student Name</th>
                                        <th>Email</th>
                                        <th>Parent Name</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($getSearchStudent as $data)
                                    <tr>
                                        <td>{{ $data->id }}</td>
                                        <td>
                                            @if($data->profile_picture !='' && file_exists(public_path().'/upload/profile/'.$data->profile_picture))
                                            <img src="{{ url('upload/profile/'.$data->profile_picture) }}" width="50" height="50" class="rounded-circle" />
                                            @else
                                            <img src="{{ url('upload/profile/avatar.jpg') }}" width="50" height="50" class="rounded-circle" />
                                            @endif
                                        </td>
                                        <td>{{ $data->name }} {{ $data->last_name }}</td>
                                        <td>{{ $data->email }}</td>
                                        <td>{{ $data->parent_name }}</td>
                                        <td>{{ date('d-m-Y H:i A', strtotime($data->created_at)) }}</td>
                                        <td style="min-width: 150px;">
                                            <a href="{{ url('admin/parent/add_student_to_parent/'.$data->id.'/'.$parent_id) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil-square" aria-hidden="true"></i> Add Student To Parent</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>



                        </div>
                    </div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Parent Student List</h3>
                        </div>
                        <div class="card-body p-0" style="overflow: auto;">
                        <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Profile</th>
                                        <th>Student Name</th>
                                        <th>Email</th>
                                        <th>Parent Name</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($getRecord as $data)
                                    <tr>
                                        <td>{{ $data->id }}</td>
                                        <td>
                                            @if($data->profile_picture !='' && file_exists(public_path().'/upload/profile/'.$data->profile_picture))
                                            <img src="{{ url('upload/profile/'.$data->profile_picture) }}" width="50" height="50" class="rounded-circle" />
                                            @else
                                            <img src="{{ url('upload/profile/avatar.jpg') }}" width="50" height="50" class="rounded-circle" />
                                            @endif
                                        </td>
                                        <td>{{ $data->name }} {{ $data->last_name }}</td>
                                        <td>{{ $data->email }}</td>
                                        <td>{{ $data->parent_name }}</td>
                                        <td>{{ date('d-m-Y H:i A', strtotime($data->created_at)) }}</td>
                                        <td style="min-width: 150px;">
                                            <a href="{{ url('admin/parent/add_student_to_parent_delete/'.$data->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>



                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>

@endsection