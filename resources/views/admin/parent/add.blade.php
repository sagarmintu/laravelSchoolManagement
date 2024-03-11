@extends('layouts.app')

@section('title', 'Add New Parent')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add New Parent</h1>
                </div>
                <div class="col-sm-6">
                    <a href="{{ url('admin/parent/list') }}" class="btn btn-primary btn-sm" style="float: inline-end;"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
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
                            <h3 class="card-title">Add New Parent</h3>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>First Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Name" name="name" value="{{ old('name') }}" required>
                                        <div class="text-danger">{{ $errors->first('name') }}</div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Last Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Last Name" name="last_name" value="{{ old('last_name') }}" required>
                                        <div class="text-danger">{{ $errors->first('last_name') }}</div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Gender <span class="text-danger">*</span></label>
                                        <select name="gender" class="form-control" required>
                                            <option value="">Select Gender</option>
                                            <option {{ (old('gender') == 'Male') ? 'selected' : '' }} value="Male">Male</option>
                                            <option {{ (old('gender') == 'Female') ? 'selected' : '' }} value="Female">Female</option>
                                            <option {{ (old('gender') == 'Other') ? 'selected' : '' }} value="Other">Other</option>
                                        </select>
                                        <div class="text-danger">{{ $errors->first('gender') }}</div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Occupation</label>
                                        <input type="text" class="form-control" placeholder="Enter Occupation" name="occupation" value="{{ old('occupation') }}">
                                        <div class="text-danger">{{ $errors->first('occupation') }}</div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Mobile Number <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter Mobile Number" name="mobile_number" value="{{ old('mobile_number') }}" required>
                                        <div class="text-danger">{{ $errors->first('mobile_number') }}</div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Address <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter Address" name="address" value="{{ old('address') }}" required>
                                        <div class="text-danger">{{ $errors->first('address') }}</div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Profile Picture</label>
                                        <input type="file" class="form-control" name="profile_picture">
                                        <div class="text-danger">{{ $errors->first('profile_picture') }}</div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Status </label>
                                        <select name="status" class="form-control" required>
                                            <option value="">Select Status</option>
                                            <option {{ (old('status') == 0) ? 'selected' : '' }} value="0">Active</option>
                                            <option {{ (old('status') == 1) ? 'selected' : '' }} value="1">Inactive</option>
                                        </select>
                                        <div class="text-danger">{{ $errors->first('status') }}</div>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group">
                                    <label>Email address <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" placeholder="Email address" name="email" value="{{ old('email') }}" required>
                                    <div class="text-danger">{{ $errors->first('email') }}</div>
                                </div>

                                <div class="form-group">
                                    <label>Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" placeholder="Password" name="password" required>
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