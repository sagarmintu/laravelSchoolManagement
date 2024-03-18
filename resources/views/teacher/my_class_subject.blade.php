@extends('layouts.app')

@section('title', 'List Of Class & Subject')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>List Of Class & Subject (Total Record: {{ $getRecord->total() }})</h1>
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
                            <h3 class="card-title">List Of Class & Subject</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Class Name</th>
                                        <th>Subject Name</th>
                                        <th>Subject Type</th>
                                        <th>My Class Timetable</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($getRecord as $value)
                                        <tr>
                                            <td>{{ $value->class_name }}</td>
                                            <td>{{ $value->subject_name }}</td>
                                            <td>
                                                @if ($value->subject_type == 'Theory')
                                                <span class="badge badge-success">Theory</span>
                                                @elseif ($value->subject_type == 'Practical')
                                                <span class="badge badge-danger">Practical</span>
                                                @endif
                                            </td>
                                            <td>
                                                @php
                                                    $classSubject = $value->getTimetable($value->class_id, $value->subject_id);
                                                @endphp

                                                @if(!empty($classSubject))
                                                    {{ date('H:i A', strtotime($classSubject->start_time)) }} to {{ date('H:i A', strtotime($classSubject->end_time)) }}
                                                    <br>
                                                    Room Number: {{ $classSubject->room_number }}
                                                @endif

                                            </td>
                                            <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                                            <td><a href="{{ url('teacher/class_subject/class_timetable/'.$value->class_id.'/'.$value->subject_id) }}" class="btn btn-primary">Class Timetable</a></td>
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