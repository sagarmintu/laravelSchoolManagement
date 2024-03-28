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
                                            <th>Subject</th>
                                            <th>Class Work</th>
                                            <th>Test Work</th>
                                            <th>Home Work</th>
                                            <th>Exam</th>
                                            <th>Total Score</th>
                                            <th>Pass Work</th>
                                            <th>Full Mark</th>
                                            <th>Result</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $total_score = 0;
                                            $full_mark = 0;
                                            $result_validate = 0;
                                        @endphp

                                        @foreach($value['subject'] as $exam)

                                        @php
                                            $total_score = $total_score + $exam['total_score'];
                                            $full_mark = $full_mark + $exam['full_mark'];
                                        @endphp

                                            <tr>
                                                <td style="width: 300px;">{{ $exam['subject_name'] }}</td>
                                                <td>{{ $exam['class_work'] }}</td>
                                                <td>{{ $exam['home_work'] }}</td>
                                                <td>{{ $exam['test_work'] }}</td>
                                                <td>{{ $exam['exam'] }}</td>
                                                <td>{{ $exam['total_score'] }}</td>
                                                <td>{{ $exam['pass_mark'] }}</td>
                                                <td>{{ $exam['full_mark'] }}</td>
                                                <td>
                                                    @if($exam['total_score'] >= $exam['pass_mark'])
                                                        <span style="color: green; font-weight: bold;">Pass</span>
                                                    @else
                                                        @php
                                                            $result_validate = 1;
                                                        @endphp
                                                        <span style="color: red; font-weight: bold;">Fail</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                            <tr>
                                                <td colspan="2">
                                                    <b>Grand Total : {{ $total_score }} / {{ $full_mark }}</b>
                                                </td>
                                                <td colspan="3">
                                                    <b>Percentage : {{ round(($total_score * 100) / $full_mark,2) }}%</b>
                                                </td>
                                                <td colspan="5">
                                                    <b>Result : 
                                                        @if($result_validate == 0) 
                                                            <span style="color: green; font-weight: bold;">Pass</span> 
                                                        @else 
                                                            <span style="color: red; font-weight: bold;">Fail</span>
                                                        @endif
                                                    </b>
                                                </td>
                                            </tr>
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