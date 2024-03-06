@extends('layouts.app')

@section('title', 'Change Password')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Change Password</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            @include('message')
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Change Password</h3>
            </div>
            <form action="" method="post">
              {{ csrf_field() }}
              <div class="card-body">
                <div class="form-group">
                  <label>Old Password</label>
                  <input type="password" class="form-control" placeholder="Enter Old Password" name="old_password" required>
                </div>

                <div class="form-group">
                  <label>New Password</label>
                  <input type="password" class="form-control" placeholder="Enter New Password" name="new_password" required>
                </div>

              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-success" name="submit" value="submit">update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

@endsection