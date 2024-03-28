@extends('layouts.app')

@section('title', 'Mark Regsiter')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Mark Regsiter</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Search Mark Regsiter</h3>
                        </div>
                        <form action="" method="get">
                            <div class="card-body">
                                <div class="row">

                                    <div class="form-group col-md-3">
                                        <label>Exam</label>
                                        <select name="exam_id" class="form-control" required>
                                            <option value="">Select Exam</option>
                                            @foreach($getExam as $exam)
                                            <option {{ (Request::get('exam_id') == $exam->id) ? 'selected' : '' }} value="{{ $exam->id }}">{{ $exam->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Class Name</label>
                                        <select name="class_id" class="form-control" required>
                                            <option value="">Select Class</option>
                                            @foreach($getClass as $class)
                                            <option {{ (Request::get('class_id') == $class->id) ? 'selected' : '' }} value="{{ $class->id }}">{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <button class="btn btn-primary btn-sm" type="submit" style="margin-top: 34px;">Search</button>
                                        <a href="{{ url('admin/examinations/mark_register') }}" class="btn btn-success btn-sm" type="submit" style="margin-top: 34px;">Clear</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    @include('message')

                    @if(!empty($getSubject) && !empty($getSubject->count()))
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Mark Regsiter</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Student Name</th>
                                        @foreach($getSubject as $subject)
                                        <th>
                                            {{ $subject->subject_name }} <br>
                                            ({{ $subject->subject_type }} : {{ $subject->full_mark }} / {{ $subject->pass_mark }})
                                        </th>
                                        @endforeach
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($getStudent) && !empty($getStudent->count()))
                                    @foreach($getStudent as $student)
                                        <form method="post" class="submitForm">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="student_id" value="{{ $student->id }}">
                                            <input type="hidden" name="exam_id" value="{{ Request::get('exam_id') }}">
                                            <input type="hidden" name="class_id" value="{{ Request::get('class_id') }}">
                                            <tr>
                                                <td>{{ $student->user_name }} {{ $student->user_lastname }}</td>
                                                @php
                                                    $i = 1;
                                                    $totalStudentMark = 0;
                                                    $totalFullMark = 0;
                                                    $totalPassMark = 0;
                                                    $pass_fail_validation = 0;
                                                @endphp

                                                @foreach($getSubject as $subject)

                                                @php
                                                    $totalMark = 0;
                                                    $totalFullMark = $totalFullMark + $subject->full_mark;
                                                    $totalPassMark = $totalPassMark + $subject->pass_mark;
                                                    $getMark = $subject->getMark($student->id, Request::get('exam_id'), Request::get('class_id'), $subject->subject_id);

                                                    if(!empty($getMark))
                                                    {
                                                        $totalMark = $getMark->class_work + $getMark->home_work + $getMark->test_work + $getMark->exam;
                                                    }

                                                    $totalStudentMark = $totalStudentMark + $totalMark;

                                                @endphp

                                                    <td>
                                                        <div style="margin-bottom: 10px;">
                                                            Class Work :
                                                            
                                                            <input type="hidden" name="mark[{{ $i }}][full_mark]" value="{{ $subject->full_mark }}">

                                                            <input type="hidden" name="mark[{{ $i }}][pass_mark]" value="{{ $subject->pass_mark }}">

                                                            <input type="hidden" name="mark[{{ $i }}][id]" value="{{ $subject->id }}">

                                                            <input type="hidden" name="mark[{{ $i }}][subject_id]" value="{{ $subject->subject_id }}">

                                                            <input type="text" style="width: 200px;" name="mark[{{ $i }}][class_work]" class="form-control" id="class_work_{{ $student->id }}{{ $subject->subject_id }}" value="{{ !empty($getMark->class_work) ? $getMark->class_work : '' }}" placeholder="Enter Marks">

                                                        </div>
                                                        <div style="margin-bottom: 10px;">
                                                            Home Work :
                                                            <input type="text" style="width: 200px;" name="mark[{{ $i }}][home_work]" class="form-control" id="home_work_{{ $student->id }}{{ $subject->subject_id }}" value="{{ !empty($getMark->home_work) ? $getMark->home_work : '' }}" placeholder="Enter Marks">
                                                        </div>
                                                        <div style="margin-bottom: 10px;">
                                                            Test Work :
                                                            <input type="text" style="width: 200px;" name="mark[{{ $i }}][test_work]" class="form-control" id="test_work_{{ $student->id }}{{ $subject->subject_id }}" value="{{ !empty($getMark->test_work) ? $getMark->test_work : '' }}" placeholder="Enter Marks">
                                                        </div>
                                                        <div style="margin-bottom: 10px;">
                                                            Exam :
                                                            <input type="text" style="width: 200px;" name="mark[{{ $i }}][exam]" class="form-control" id="exam_{{ $student->id }}{{ $subject->subject_id }}" value="{{ !empty($getMark->exam) ? $getMark->exam : '' }}" placeholder="Enter Marks">
                                                        </div>

                                                        <div style="margin-bottom: 10px;">
                                                            <button type="button" class="btn btn-primary saveSingleSubject" id="{{ $student->id }}" data-val="{{ $subject->subject_id }}" data-exam="{{ Request::get('exam_id') }}" data-class="{{ Request::get('class_id') }}" data-schedule="{{ $subject->id }}">Save</button>
                                                        </div>

                                                        @if(!empty($getMark))
                                                        <div style="margin-bottom: 10px;">
                                                            <b>Total Mark :</b> {{ $totalMark }}
                                                            <br>
                                                            <b>Pass Mark :</b> {{ $subject->pass_mark }}
                                                            <br>
                                                            @if($totalMark >= $subject->pass_mark)
                                                                <b>Result :</b> <span style="color: green; font-weight: bold;">(Pass)</span>
                                                            @else
                                                                <b>Result :</b><span style="color: red; font-weight: bold;">(Fail)</span>
                                                                @php
                                                                    $pass_fail_validation = 1;
                                                                @endphp
                                                            @endif

                                                        </div>
                                                        @endif

                                                    </td>
                                                @php
                                                    $i++;
                                                @endphp
                                                @endforeach
                                                <td>
                                                    <button type="submit" class="btn btn-success">Save</button>
                                                    <br>
                                                    @if(!empty($totalStudentMark))
                                                        <div style="margin-top: 10px; border: 1px solid black; padding: 15px;">
                                                            <b>Total Student Mark :</b> {{ $totalStudentMark }}
                                                            <hr>
                                                            <br>
                                                            <b>Total Subject Mark :</b> {{ $totalFullMark }}
                                                            <hr>
                                                            <br>
                                                            <b>Total Passing Mark :</b> {{ $totalPassMark }}
                                                            <hr>
                                                            <br>
                                                            @php
                                                                $percentage = $totalStudentMark * 100 / $totalFullMark;
                                                            @endphp
                                                            <b>Percentage :</b> {{ round($percentage,2) }}%
                                                            <hr>
                                                            <br>
                                                            @if($pass_fail_validation == 0)
                                                                <b>Result :</b> <span style="color: green; font-weight: bold;">Pass</span>
                                                            @else
                                                                <b>Result :</b> <span style="color: red; font-weight: bold;">Fail</span>
                                                            @endif
                                                        </div>
                                                    @endif
                                                </td>
                                            </tr>
                                        </form>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@section('script')

    <script>
        $('.submitForm').submit(function(e){
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "{{ url('admin/examinations/submit_mark_register') }}",
                data: $(this).serialize(),
                dataType: "json",
                success: function(data)
                {
                    alert(data.message);
                }
            });
        });

        $('.saveSingleSubject').click(function(e){
            var student_id = $(this).attr('id');
            var subject_id = $(this).attr('data-val');
            var exam_id = $(this).attr('data-exam');
            var class_id = $(this).attr('data-class');
            var id = $(this).attr('data-schedule');
            var class_work = $('#class_work_'+student_id+subject_id).val();
            var home_work = $('#home_work_'+student_id+subject_id).val();
            var test_work = $('#test_work_'+student_id+subject_id).val();
            var exam = $('#exam_'+student_id+subject_id).val();

            $.ajax({
                type: "post",
                url: "{{ url('admin/examinations/single_submit_mark_register') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    id : id,
                    student_id : student_id,
                    subject_id : subject_id,
                    exam_id : exam_id,
                    class_id : class_id,
                    class_work : class_work,
                    home_work : home_work,
                    test_work : test_work,
                    exam : exam,

                },
                dataType: "json",
                success: function(data)
                {
                    alert(data.message);
                }
            });
        });

    </script>

@endsection