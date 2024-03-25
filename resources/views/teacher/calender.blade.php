@extends('layouts.app')

@section('style')

<style>
    .fc-daygrid-event {
        white-space: normal;
    }
</style>

@endsection

@section('title', 'Calender')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Calender</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="calendar">

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@section('script')

<script src="{{ asset('dist/fullcalendar/index.global.js') }}"></script>

<script>
    var events = new Array();

    @foreach($getClassTimetable as $value)
        events.push({
            title: '{{ $value->class_name }} - {{ $value->subject_name }}',
            daysOfWeek: [ {{ $value->fullcalender_day }} ],
            startTime: '{{ $value->start_time }}',
            endTime: '{{ $value->end_time }}',
        });
    @endforeach

    var calendarID = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarID, {
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
        },
        initialDate: '<?=date('Y-m-d')?>',
        navLinks: true,
        editable: false,
        events: events,
        // initialView: 'timeGridWeek',
    });

    calendar.render();
</script>

@endsection