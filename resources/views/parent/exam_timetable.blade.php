@extends('layouts.app')

@section('title', 'Exam Timetable')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Exam Timetable <span style="color: red;">({{ $getStudent->name }} {{ $getStudent->last_name }})</span></h1>
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

                    @foreach($getRecord as $value)
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ $value['name'] }}</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Subject Name</th>
                                        <th>Day</th>
                                        <th>Exam Date</th>
                                        <th>Start Time</th>
                                        <th>End Time By</th>
                                        <th>Room Numbers</th>
                                        <th>Full Marks</th>
                                        <th>Passing Marks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($value['exam'] as $valueE)
                                        <tr>
                                            <td>{{ $valueE['subject_name'] }}</td>
                                            <td>{{ date('l', strtotime($valueE['exam_date'])) }}</td>
                                            <td>{{ date('d-m-Y', strtotime($valueE['exam_date'])) }}</td>
                                            <td>{{ date('h:i A', strtotime($valueE['start_time'])) }}</td>
                                            <td>{{ date('h:i A', strtotime($valueE['end_time'])) }}</td>
                                            <td>{{ $valueE['room_number'] }}</td>
                                            <td>{{ $valueE['full_mark'] }}</td>
                                            <td>{{ $valueE['pass_mark'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
</div>

@endsection