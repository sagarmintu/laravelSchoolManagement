@extends('layouts.app')

@section('title', 'Exam Result')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Exam Result</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">

                @foreach($getRecord as $value)
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><span style="color: blue; font-weight: bold;">{{ $value['exam_name'] }}</span></h3>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Subject Name</th>
                                            <th>Class Work</th>
                                            <th>Test Work</th>
                                            <th>Home Work</th>
                                            <th>Exam</th>
                                            <th>Total Score</th>
                                            <th>Pass Work</th>
                                            <th>Full Mark</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($value['subject'] as $exam)
                                            <tr>
                                                <td>{{ $exam['subject_name'] }}</td>
                                                <td>{{ $exam['class_work'] }}</td>
                                                <td>{{ $exam['home_work'] }}</td>
                                                <td>{{ $exam['test_work'] }}</td>
                                                <td>{{ $exam['exam'] }}</td>
                                                <td>{{ $exam['total_score'] }}</td>
                                                <td>{{ $exam['pass_mark'] }}</td>
                                                <td>{{ $exam['full_mark'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
</div>

@endsection