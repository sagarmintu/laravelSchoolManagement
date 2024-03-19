@extends('layouts.app')

@section('title', 'My Student Subject')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Student Name : <span class="text-success font-weight-bold">({{ $user->name }} {{ $user->last_name }})</span></h1>
                </div>
                <div class="col-sm-6">
                    <a href="{{ url('parent/my_student') }}" class="btn btn-primary btn-sm" style="float: inline-end;"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
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
                            <h3 class="card-title">Student Subject List</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Subject Name</th>
                                        <th>Subject Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($getRecord as $data)
                                    <tr>
                                        <td>{{ $data->id }}</td>
                                        <td>{{ $data->subjects_name }}</td>
                                        <td>{{ $data->subjects_type }}</td>
                                        <td><a href="{{ url('parent/my_student/subject/class_timetable/'.$data->class_id.'/'.$data->subject_id.'/'.$user->id) }}" class="btn btn-primary">Class Timetable</a></td>
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