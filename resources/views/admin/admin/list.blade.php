@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Admin List</h1>
          </div>
          <div class="col-sm-6">
            <a href="{{ url('admin/admin/add') }}" class="btn btn-primary btn-sm" style="float: inline-end;"><i class="fa fa-plus" aria-hidden="true"></i> Add</a>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            @include('message')
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Admin List With Table</h3>
              </div>
              <!-- /.card-header -->
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
                      <td>{{ $data->created_at }}</td>
                      <td>
                        <a href="{{ url('admin/admin/edit/'.$data->id) }}" class="btn btn-success btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                        <a href="{{ url('admin/admin/delete/'.$data->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection