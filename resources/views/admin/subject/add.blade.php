@extends('layouts.app')

@section('title', 'Add New Subject')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Add New Subject</h1>
        </div>
        <div class="col-sm-6">
          <a href="{{ url('admin/subject/list') }}" class="btn btn-primary btn-sm" style="float: inline-end;"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
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
              <h3 class="card-title">Add New Subject</h3>
            </div>
            <form action="" method="post">
              {{ csrf_field() }}
              <div class="card-body">
                <div class="form-group">
                  <label>Subject Name</label>
                  <input type="text" class="form-control" placeholder="Subject Name" name="name" required>
                </div>

                <div class="form-group">
                  <label>Subject Type</label>
                  <select name="type" class="form-control">
                    <option value="">Select Type</option>
                    <option value="Theory">Theory</option>
                    <option value="Practical">Practical</option>
                  </select>
                </div>

                <div class="form-group">
                  <label>Status</label>
                  <select name="status" class="form-control">
                    <option value="0">Active</option>
                    <option value="1">Inactive</option>
                  </select>
                </div>

              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

@endsection