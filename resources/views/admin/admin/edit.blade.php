@extends('layouts.app')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Admin</h1>
        </div>
        <div class="col-sm-6">
          <a href="{{ url('admin/admin/list') }}" class="btn btn-primary btn-sm" style="float: inline-end;"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Edit Admin</h3>
            </div>
            <form action="" method="post">
              {{ csrf_field() }}
              <div class="card-body">
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" class="form-control" placeholder="Name" name="name" value="{{ $getRecord->name }}" required>
                </div>
                <div class="form-group">
                  <label>Email address</label>
                  <input type="email" class="form-control" placeholder="Email address" name="email" value="{{ $getRecord->email }}" required>
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="text" class="form-control" placeholder="Password" name="password">
                  <p>Do You Want To Change The Password ? Then Add New Password</p>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-success" name="submit" value="submit">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

@endsection