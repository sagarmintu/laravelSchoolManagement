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
                                            {{ $subject->subject_name }}  <br>
                                            ({{ $subject->subject_type }} : {{ $subject->full_mark }} / {{ $subject->pass_mark }})
                                        </th>
                                        @endforeach
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($getStudent) && !empty($getStudent->count()))
                                        @foreach($getStudent as $student)
                                            <tr>
                                                <td>{{ $student->user_name }} {{ $student->user_lastname }}</td>
                                                @foreach($getSubject as $subject)
                                                <td>
                                                    <div style="margin-bottom: 10px;">
                                                        Class Work :
                                                        <input type="text" style="width: 200px;" name="" class="form-control" placeholder="Enter Marks">
                                                    </div>
                                                    <div style="margin-bottom: 10px;">
                                                        Home Work :
                                                        <input type="text" style="width: 200px;" name="" class="form-control" placeholder="Enter Marks">
                                                    </div>
                                                    <div style="margin-bottom: 10px;">
                                                        Test Work :
                                                        <input type="text" style="width: 200px;" name="" class="form-control" placeholder="Enter Marks">
                                                    </div>
                                                    <div style="margin-bottom: 10px;">
                                                        Exam :
                                                        <input type="text" style="width: 200px;" name="" class="form-control" placeholder="Enter Marks">
                                                    </div>
                                                </td>
                                                @endforeach
                                                <td>
                                                    <button type="button" class="btn btn-success">Save</button>
                                                </td>
                                            </tr>
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