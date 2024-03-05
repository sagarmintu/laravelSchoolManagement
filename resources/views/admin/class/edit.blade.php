@extends('layouts.app')

@section('title', 'Edit Class')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Class</h1>
        </div>
        <div class="col-sm-6">
          <a href="{{ url('admin/class/list') }}" class="btn btn-primary btn-sm" style="float: inline-end;"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
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
              <h3 class="card-title">Edit Class</h3>
            </div>
            <form action="" method="post">
              {{ csrf_field() }}
              <div class="card-body">
                <div class="form-group">
                  <label>Class Name</label>
                  <input type="text" class="form-control" placeholder="Class Name" name="name" value="{{ $getRecord->name }}">
                </div>

                <div class="form-group">
                  <label>Status</label>
                  <select name="status" class="form-control">
                    <option {{ ($getRecord->status == 0) ? 'selected':'' }} value="0">Active</option>
                    <option {{ ($getRecord->status == 1) ? 'selected':'' }} value="1">Inactive</option>
                  </select>
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