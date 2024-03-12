@extends('layouts.app')

@section('title', 'Parent List')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Parent List (Total Record: {{ $getRecord->total() }})</h1>
                </div>
                <div class="col-sm-6">
                    <a href="{{ url('admin/parent/add') }}" class="btn btn-primary btn-sm" style="float: inline-end;"><i class="fa fa-plus" aria-hidden="true"></i> Add</a>
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
                            <h3 class="card-title">Search Parent</h3>
                        </div>
                        <form action="" method="get">
                            <div class="card-body">
                            <div class="row">
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
                                    <div class="form-group col-md-2">
                                        <label>Gender</label>
                                        <select name="gender" class="form-control">
                                            <option value="">Select Gender</option>
                                            <option {{ (Request::get('gender') == 'Male') ? 'selected' : '' }} value="Male">Male</option>
                                            <option {{ (Request::get('gender') == 'Female') ? 'selected' : '' }} value="Female">Female</option>
                                            <option {{ (Request::get('gender') == 'Other') ? 'selected' : '' }} value="Other">Other</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Occupation</label>
                                        <input type="text" class="form-control" placeholder="Occupation" name="occupation" value="{{ Request::get('occupation') }}">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Address</label>
                                        <input type="text" class="form-control" placeholder="Address" name="address" value="{{ Request::get('address') }}">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Mobile Number</label>
                                        <input type="text" class="form-control" placeholder="Mobile Number" name="mobile_number" value="{{ Request::get('mobile_number') }}">
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
                                        <label>Created Date</label>
                                        <input type="date" class="form-control" name="date" value="{{ Request::get('date') }}">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <button class="btn btn-primary btn-sm" type="submit" style="margin-top: 34px;">Search</button>
                                        <a href="{{ url('admin/parent/list') }}" class="btn btn-success btn-sm" type="submit" style="margin-top: 34px;">Clear</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    @include('message')
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Parent List</h3>
                        </div>
                        <div class="card-body p-0" style="overflow: auto;">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Profile</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>Phone</th>
                                        <th>Occupation</th>
                                        <th>Address</th>
                                        <th>Status</th>
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
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->email }}</td>
                                        <td>{{ $data->gender }}</td>
                                        <td>{{ $data->mobile_number }}</td>
                                        <td>{{ $data->occupation }}</td>
                                        <td>{{ $data->address }}</td>
                                        <td>
                                            @if ($data->status == 0)
                                            <span class="badge badge-success">Active</span>
                                            @elseif ($data->status == 1)
                                            <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>{{ date('d-m-Y H:i A', strtotime($data->created_at)) }}</td>
                                        <td>
                                            <a href="{{ url('admin/parent/edit/'.$data->id) }}" class="btn btn-success btn-sm"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit</a>
                                            <a href="{{ url('admin/parent/delete/'.$data->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                                            <a href="{{ url('admin/parent/my_student/'.$data->id) }}" class="btn btn-primary btn-sm">My Student</a>
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