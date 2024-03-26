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
                                                @endphp

                                                @foreach($getSubject as $subject)

                                                @php
                                                    $getMark = $subject->getMark($student->id, Request::get('exam_id'), Request::get('class_id'), $subject->subject_id);
                                                @endphp
                                                    <td>
                                                        <div style="margin-bottom: 10px;">
                                                            Class Work :
                                                            <input type="hidden" name="mark[{{ $i }}][subject_id]" value="{{ $subject->subject_id }}">
                                                            <input type="text" style="width: 200px;" name="mark[{{ $i }}][class_work]" class="form-control" value="{{ !empty($getMark->class_work) ? $getMark->class_work : '' }}" placeholder="Enter Marks">
                                                        </div>
                                                        <div style="margin-bottom: 10px;">
                                                            Home Work :
                                                            <input type="text" style="width: 200px;" name="mark[{{ $i }}][home_work]" class="form-control" value="{{ !empty($getMark->home_work) ? $getMark->home_work : '' }}" placeholder="Enter Marks">
                                                        </div>
                                                        <div style="margin-bottom: 10px;">
                                                            Test Work :
                                                            <input type="text" style="width: 200px;" name="mark[{{ $i }}][test_work]" class="form-control" value="{{ !empty($getMark->test_work) ? $getMark->test_work : '' }}" placeholder="Enter Marks">
                                                        </div>
                                                        <div style="margin-bottom: 10px;">
                                                            Exam :
                                                            <input type="text" style="width: 200px;" name="mark[{{ $i }}][exam]" class="form-control" value="{{ !empty($getMark->exam) ? $getMark->exam : '' }}" placeholder="Enter Marks">
                                                        </div>
                                                    </td>
                                                @php
                                                    $i++;
                                                @endphp
                                                @endforeach
                                                <td>
                                                    <button type="submit" class="btn btn-success">Save</button>
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
    </script>

@endsection