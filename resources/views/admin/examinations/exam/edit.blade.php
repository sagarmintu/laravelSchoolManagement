@extends('layouts.app')

@section('title', 'Edit New Exam')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit New Exam</h1>
        </div>
        <div class="col-sm-6">
          <a href="{{ url('admin/examinations/exam/list') }}" class="btn btn-primary btn-sm" style="float: inline-end;"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
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
              <h3 class="card-title">Edit New Exam</h3>
            </div>
            <form action="" method="post">
              {{ csrf_field() }}
              <div class="card-body">
                <div class="form-group">
                  <label>Exam Name</label>
                  <input type="text" class="form-control" placeholder="Exam Name" name="name" value="{{ old('name', $getRecord->name) }}" required>
                </div>
                <div class="form-group">
                  <label>Note</label>
                  <textarea name="note" class="form-control" placeholder="Note">{{ old('note', $getRecord->note) }}</textarea>
                  <span class="text-danger">{{ $errors->first('email') }}</span>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-success">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

@endsection