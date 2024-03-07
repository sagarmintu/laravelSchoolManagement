@extends('layouts.app')

@section('title', 'Add New Student')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add New Student</h1>
                </div>
                <div class="col-sm-6">
                    <a href="{{ url('admin/student/list') }}" class="btn btn-primary btn-sm" style="float: inline-end;"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
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
                            <h3 class="card-title">Add New Student</h3>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>First Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Name" name="name" value="{{ old('name') }}" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Last Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Last Name" name="last_name" value="{{ old('last_name') }}" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Admission Number <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Admission Number" name="admission_number" value="{{ old('admission_number') }}" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Roll Number</label>
                                        <input type="text" class="form-control" placeholder="Roll Number" name="roll_number" value="{{ old('roll_number') }}">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Class Name <span class="text-danger">*</span></label>
                                        <select name="class_id" class="form-control" required>
                                            <option value="">Select class</option>
                                            @foreach($getClass as $class)
                                             <option value="{{ $class->id }}">{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Gender <span class="text-danger">*</span></label>
                                        <select name="gender" class="form-control" required>
                                            <option value="">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Date Of Birth <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="date_of_birth" value="{{ old('date_of_birth') }}" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Caste</label>
                                        <input type="text" class="form-control" placeholder="Enter Caste" name="caste" value="{{ old('caste') }}">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Religion</label>
                                        <input type="text" class="form-control" placeholder="Enter Religion" name="religion" value="{{ old('religion') }}">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Mobile Number</label>
                                        <input type="text" class="form-control" placeholder="Enter Mobile Number" name="mobile_number" value="{{ old('mobile_number') }}">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Admission Date <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" placeholder="Enter Mobile Number" name="admission_date" value="{{ old('admission_date') }}">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Profile Picture</label>
                                        <input type="file" class="form-control" name="profile_picture">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Blood Group <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="blood_group" value="{{ old('blood_group') }}" placeholder="Enter Blood Group" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Height <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="height" value="{{ old('height') }}" placeholder="Enter Height" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Weight <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="weight" value="{{ old('weight') }}" placeholder="Enter Weight" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Status </label>
                                        <select name="status" class="form-control" required>
                                            <option value="">Select Status</option>
                                            <option value="0">Active</option>
                                            <option value="1">Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group">
                                    <label>Email address <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" placeholder="Email address" name="email" value="{{ old('email') }}" required>
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
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