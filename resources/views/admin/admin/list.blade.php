@extends('layouts.app')

@section('title', 'Admin List')

@section('content')

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Admin List (Total Record: {{ $getRecord->total() }})</h1>
        </div>
        <div class="col-sm-6">
          <a href="{{ url('admin/admin/add') }}" class="btn btn-primary btn-sm" style="float: inline-end;"><i class="fa fa-plus" aria-hidden="true"></i> Add</a>
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
              <h3 class="card-title">Search Admin</h3>
            </div>
            <form action="" method="get">
              <div class="card-body">
                <div class="row">
                  <div class="form-group col-md-3">
                    <label>Name</label>
                    <input type="text" class="form-control" placeholder="Name" name="name" value="{{ Request::get('name') }}">
                  </div>
                  <div class="form-group col-md-3">
                    <label>Email address</label>
                    <input type="text" class="form-control" placeholder="Email address" name="email" value="{{ Request::get('email') }}">
                  </div>
                  <div class="form-group col-md-3">
                    <label>Date</label>
                    <input type="date" class="form-control" placeholder="Enter Date" name="date" value="{{ Request::get('date') }}">
                  </div>
                  <div class="form-group col-md-3">
                    <button class="btn btn-primary btn-sm" type="submit" style="margin-top: 34px;">Search</button>
                    <a href="{{ url('admin/admin/list') }}" class="btn btn-success btn-sm" type="submit" style="margin-top: 34px;">Clear</a>
                  </div>
                </div>
              </div>
            </form>
          </div>


          @include('message')
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Admin List</h3>
            </div>
            <div class="card-body p-0">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($getRecord as $data)
                  <tr>
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->email }}</td>
                    <td>{{ date('d-m-Y H:i A', strtotime($data->created_at)) }}</td>
                    <td>
                      <a href="{{ url('admin/admin/edit/'.$data->id) }}" class="btn btn-success btn-sm"><i class="fa fa-pencil-square" aria-hidden="true"></i> Edit</a>
                      <a href="{{ url('admin/admin/delete/'.$data->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
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