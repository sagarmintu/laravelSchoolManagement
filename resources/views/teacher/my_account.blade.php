@extends('layouts.app')

@section('title', 'My Account')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Account Details</h1>
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
                            <h3 class="card-title">My Account</h3>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>First Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Name" name="name" value="{{ old('name', $getRecord->name) }}" required>
                                        <div class="text-danger">{{ $errors->first('name') }}</div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Last Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Last Name" name="last_name" value="{{ old('last_name', $getRecord->last_name) }}" required>
                                        <div class="text-danger">{{ $errors->first('last_name') }}</div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Gender <span class="text-danger">*</span></label>
                                        <select name="gender" class="form-control" required>
                                            <option value="">Select Gender</option>
                                            <option {{ (old('gender', $getRecord->gender) == 'Male') ? 'selected' : '' }} value="Male">Male</option>
                                            <option {{ (old('gender', $getRecord->gender) == 'Female') ? 'selected' : '' }} value="Female">Female</option>
                                            <option {{ (old('gender', $getRecord->gender) == 'Other') ? 'selected' : '' }} value="Other">Other</option>
                                        </select>
                                        <div class="text-danger">{{ $errors->first('gender') }}</div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Date Of Birth <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="date_of_birth" value="{{ old('date_of_birth', $getRecord->date_of_birth) }}" required>
                                        <div class="text-danger">{{ $errors->first('date_of_birth') }}</div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Mobile Number</label>
                                        <input type="text" class="form-control" placeholder="Enter Mobile Number" name="mobile_number" value="{{ old('mobile_number', $getRecord->mobile_number) }}">
                                        <div class="text-danger">{{ $errors->first('mobile_number') }}</div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Marital Status</label>
                                        <input type="text" class="form-control" placeholder="Enter Marital Status" name="marital_status" value="{{ old('marital_status', $getRecord->marital_status) }}">
                                        <div class="text-danger">{{ $errors->first('marital_status') }}</div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Profile Picture</label>
                                        <input type="file" class="form-control" name="profile_picture">
                                        <div class="text-danger">{{ $errors->first('profile_picture') }}</div>
                                        @if(!empty($getRecord->getProfile()))
                                            <img src="{{ $getRecord->getProfile() }}" style="width: auto; height: 50px;">
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Current Address</label>
                                        <textarea name="address" class="form-control">{{ old('address', $getRecord->address) }}</textarea>
                                        <div class="text-danger">{{ $errors->first('address') }}</div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Permanent Address</label>
                                        <textarea name="permanent_address" class="form-control">{{ old('permanent_address', $getRecord->permanent_address) }}</textarea>
                                        <div class="text-danger">{{ $errors->first('permanent_address') }}</div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Qualification</label>
                                        <textarea name="qualification" class="form-control">{{ old('qualification', $getRecord->qualification) }}</textarea>
                                        <div class="text-danger">{{ $errors->first('qualification') }}</div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Work Experience</label>
                                        <textarea name="work_experience" class="form-control">{{ old('work_experience', $getRecord->work_experience) }}</textarea>
                                        <div class="text-danger">{{ $errors->first('work_experience') }}</div>
                                    </div>

                                </div>

                                <hr>

                                <div class="form-group">
                                    <label>Email address <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" placeholder="Email address" name="email" value="{{ old('email', $getRecord->email) }}" required>
                                    <div class="text-danger">{{ $errors->first('email') }}</div>
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