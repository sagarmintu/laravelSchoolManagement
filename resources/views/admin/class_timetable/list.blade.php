@extends('layouts.app')

@section('title', 'Class Timetable List')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Class Timetable List (Total Record: )</h1>
                </div>
                <div class="col-sm-6">
                    <a href="{{ url('admin/class_timetable/add') }}" class="btn btn-primary btn-sm" style="float: inline-end;"><i class="fa fa-plus" aria-hidden="true"></i> Add</a>
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
                            <h3 class="card-title">Search Class Timetable</h3>
                        </div>
                        <form action="" method="get">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label>Class Name</label>
                                        <select name="class_id" class="form-control getClass" required>
                                            <option value="">select Class</option>
                                            @foreach($getClass as $class)
                                            <option {{ (Request::get('class_id') == $class->id) ? 'selected' : '' }} value="{{ $class->id }}">{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Subject Name</label>
                                        <select name="subject_id" class="form-control getSubject" required>
                                            <option value="">select Subject</option>
                                            @if(!empty($getSubject))
                                            @foreach($getSubject as $subject)
                                            <option {{ (Request::get('subject_id') == $subject->subject_id) ? 'selected' : '' }} value="{{ $subject->subject_id }}">{{ $subject->subjects_name }}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <button class="btn btn-primary btn-sm" type="submit" style="margin-top: 34px;">Search</button>
                                        <a href="{{ url('admin/class_timetable/list') }}" class="btn btn-success btn-sm" type="submit" style="margin-top: 34px;">Clear</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    @include('message')

                    @if(!empty(Request::get('class_id')) && !empty(Request::get('subject_id')))
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Timetable</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Week</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Room Number</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($week as $value)
                                    <tr>
                                        <td>{{ $value['week_name'] }}</td>
                                        <td>
                                            <input type="time" name="start_time" class="form-control">
                                        </td>
                                        <td>
                                            <input type="time" name="end_time" class="form-control">
                                        </td>
                                        <td>
                                            <input type="text" style="width: 200px;" name="room_number" class="form-control">
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div style="text-align: right; padding: 20px;">
                                <button class="btn btn-primary">Submit</button>
                            </div>
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
    $('.getClass').change(function() {
        var class_id = $(this).val();
        $.ajax({
            url: "{{ url('admin/class_timetable/get_subject') }}",
            type: "post",
            data: {
                "_token": "{{ csrf_token() }}",
                class_id: class_id,
            },
            dataType: "json",
            success: function(response) {
                $('.getSubject').html(response.html);
            }
        });
    });
</script>

@endsection