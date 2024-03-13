@extends('layouts.app')

@section('title', 'My Student')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Student Details (Total Record: {{ $getRecord->total() }})</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('message')
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">My Student List</h3>
                        </div>
                        <div class="card-body p-0" style="overflow: auto;">
                        <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Profile</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Admission Number</th>
                                        <th>Roll Number</th>
                                        <th>Class</th>
                                        <th>Gender</th>
                                        <th>Date Of Birth</th>
                                        <th>Caste</th>
                                        <th>Religion</th>
                                        <th>Mobile Number</th>
                                        <th>Admission Date</th>
                                        <th>Blood Group</th>
                                        <th>Height</th>
                                        <th>Weight</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($getRecord as $data)
                                    <tr>
                                        <td>
                                            @if($data->profile_picture !='' && file_exists(public_path().'/upload/profile/'.$data->profile_picture))
                                            <img src="{{ url('upload/profile/'.$data->profile_picture) }}" width="50" height="50" class="rounded-circle" />
                                            @else
                                            <img src="{{ url('upload/profile/avatar.jpg') }}" width="50" height="50" class="rounded-circle" />
                                            @endif
                                        </td>
                                        <td>{{ $data->name }} {{ $data->last_name }}</td>
                                        <td>{{ $data->email }}</td>
                                        <td>{{ $data->admission_number }}</td>
                                        <td>{{ $data->roll_number }}</td>
                                        <td>{{ $data->class_name }}</td>
                                        <td>{{ $data->gender }}</td>

                                        <td>
                                            @if(!empty($data->date_of_birth))
                                            {{ date('d-m-Y', strtotime($data->date_of_birth)) }}
                                            @endif
                                        </td>

                                        <td>{{ $data->caste }}</td>
                                        <td>{{ $data->religion }}</td>
                                        <td>{{ $data->mobile_number }}</td>
                                        <td>
                                            @if(!empty($data->admission_date))
                                            {{ date('d-m-Y', strtotime($data->admission_date)) }}
                                            @endif
                                        </td>
                                        <td>{{ $data->blood_group }}</td>
                                        <td>{{ $data->height }}</td>
                                        <td>{{ $data->weight }}</td>
                                        <td>{{ date('d-m-Y H:i A', strtotime($data->created_at)) }}</td>
                                        <td>
                                            <a href="{{ url('parent/my_student/subject/'.$data->id) }}" class="btn btn-primary btn-sm">Subject List</a>
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