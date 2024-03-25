@extends('layouts.app')

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

    @foreach($getMyTimetable as $value)
        @foreach($value['week'] as $week)
        events.push({
            title: '{{ $value['name'] }}',
            daysOfWeek: [{{ $week['fullcalender_day'] }}],
            startTime: '{{ $week['start_time'] }}',
            endTime: '{{ $week['end_time'] }}',
        });
        @endforeach
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
        initialView: 'timeGridWeek',
    });

    calendar.render();
</script>

@endsection