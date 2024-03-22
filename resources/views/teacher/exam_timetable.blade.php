@extends('layouts.app')

@section('title', 'Exam Timetable')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Exam Timetable</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    @foreach($getRecord as $value)
                    <h2 style="font-size: 32px; margin-bottom: 15px;"><b>class</b> : <span style="color: blue;">{{ $value['class_name'] }}</span></h2>
                    @foreach($value['exam'] as $exam)
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><b>Exam Name</b> : <span style="color: red;">{{ $exam['exam_name'] }}</span></h3>
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
                                    @foreach($exam['subject'] as $valueE)
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
                    @endforeach

                </div>
            </div>
        </div>
    </section>
</div>

@endsection